<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class CustomRole extends Model implements RoleContract
{
    use HasPermissions;
    use RefreshesPermissionCache;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name', 
        'role_description',
        'role_guard_name',
        'role_status',
        'org_id',
    ];
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        $attributes['role_guard_name'] ??= Guard::getDefaultName(static::class);
        parent::__construct($attributes);
        $this->guarded[] = $this->primaryKey;
    }

    // Accessors
    public function getNameAttribute()
    {
        return $this->attributes['role_name'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['role_name'] = $value;
    }

    public function getGuardNameAttribute()
    {
        return $this->attributes['role_guard_name'];
    }

    public function setGuardNameAttribute($value)
    {
        $this->attributes['role_guard_name'] = $value;
    }

    public static function create(array $attributes = [])
    {
        $attributes['role_guard_name'] ??= Guard::getDefaultName(static::class);
        $params = ['role_name' => $attributes['role_name'], 'role_guard_name' => $attributes['role_guard_name']];

        if (app(PermissionRegistrar::class)->teams) {
            $teamsKey = app(PermissionRegistrar::class)->teamsKey;
            if (array_key_exists($teamsKey, $attributes)) {
                $params[$teamsKey] = $attributes[$teamsKey];
            } else {
                $attributes[$teamsKey] = getPermissionsTeamId();
            }
        }

        if (static::findByParam($params)) {
            throw RoleAlreadyExists::create($attributes['role_name'], $attributes['role_guard_name']);
        }

        return static::query()->create($attributes);
    }

    public static function findByName(string $name, ?string $guardName = null): RoleContract
    {
        $guardName ??= Guard::getDefaultName(static::class);
        $role = static::findByParam(['role_name' => $name, 'role_guard_name' => $guardName]);

        if (! $role) {
            throw RoleDoesNotExist::named($name, $guardName);
        }

        return $role;
    }

    public static function findById(int|string $id, ?string $guardName = null): RoleContract
    {
        $guardName ??= Guard::getDefaultName(static::class);
        $role = static::findByParam([(new static)->getKeyName() => $id, 'role_guard_name' => $guardName]);

        if (! $role) {
            throw RoleDoesNotExist::withId($id, $guardName);
        }

        return $role;
    }

    public static function findOrCreate(string $name, ?string $guardName = null): RoleContract
    {
        $guardName ??= Guard::getDefaultName(static::class);
        $role = static::findByParam(['role_name' => $name, 'role_guard_name' => $guardName]);

        if (! $role) {
            return static::query()->create([
                'role_name' => $name,
                'role_guard_name' => $guardName,
            ] + (app(PermissionRegistrar::class)->teams ? [app(PermissionRegistrar::class)->teamsKey => getPermissionsTeamId()] : []));
        }

        return $role;
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        if (isset($attributes['name'])) {
            $attributes['role_name'] = $attributes['name'];
            unset($attributes['name']);
        }

        if (isset($attributes['guard_name'])) {
            $attributes['role_guard_name'] = $attributes['guard_name'];
            unset($attributes['guard_name']);
        }

        return static::query()->updateOrCreate($attributes, $values);
    }

    protected static function findByParam(array $params = []): ?RoleContract
    {
        $query = static::query();

        if (app(PermissionRegistrar::class)->teams) {
            $teamsKey = app(PermissionRegistrar::class)->teamsKey;
            $query->where(fn ($q) => $q->whereNull($teamsKey)->orWhere($teamsKey, $params[$teamsKey] ?? getPermissionsTeamId()));
            unset($params[$teamsKey]);
        }

        foreach ($params as $key => $value) {
            $query->where($key, $value);
        }

        return $query->first();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.permission'),
            config('permission.table_names.role_has_permissions'),
            app(PermissionRegistrar::class)->pivotRole,
            app(PermissionRegistrar::class)->pivotPermission
        );
    }

    public function users(): BelongsToMany
    {
        return $this->morphedByMany(
            getModelForGuard($this->attributes['role_guard_name'] ?? config('auth.defaults.guard')),
            'model',
            config('permission.table_names.model_has_roles'),
            app(PermissionRegistrar::class)->pivotRole,
            config('permission.column_names.model_morph_key')
        );
    }

    public function hasPermissionTo($permission, ?string $guardName = null): bool
    {
        if ($this->getWildcardClass()) {
            return $this->hasWildcardPermission($permission, $guardName);
        }

        $permission = $this->filterPermission($permission, $guardName);

        if (! $this->getGuardNames()->contains($permission->guard_name)) {
            throw GuardDoesNotMatch::create($permission->guard_name, $guardName ? collect([$guardName]) : $this->getGuardNames());
        }

        return $this->loadMissing('permissions')->permissions
            ->contains($permission->getKeyName(), $permission->getKey());
    }
}
