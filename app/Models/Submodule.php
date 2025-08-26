<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomPermission as Permission;
use App\Models\CustomRole as Role;

class Submodule extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'submodule_id';
    protected $fillable = [
        'submodule_name',
        'submodule_description',
        'submodule_status',
        'module_id',
    ];

    // Belongs to a Module
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_has_submodule_permissions', 'submodule_id', 'role_id')
            ->withPivot('permission_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_has_submodule_permissions', 'submodule_id', 'permission_id')
            ->withPivot('role_id');
    }

    public function getSubmodulePermissionName()
    {
        $moduleName = $this->module->module_name;
        $permission = 'access ' . strtolower(str_replace(' ', '_', $this->submodule_name)) . ' of ' . strtolower(str_replace(' ', '_', $moduleName));
        return $permission;
    }

    public function permissionsForRole($roleId)
    {
        return $this->belongsToMany(Permission::class, 'role_has_submodule_permissions', 'submodule_id', 'permission_id')
        ->where('role_has_submodule_permissions.role_id', $roleId);
    }
}
