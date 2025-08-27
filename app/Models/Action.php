<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomPermission as Permission;

class Action extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'action_id';
    protected $fillable = [
        'action_name',
        'action_description',
        'action_status',
        'action_created',
        'action_updated',
        'submodule_id',
    ];

    // Belongs to a Module
    public function submodule()
    {
        return $this->belongsTo(Submodule::class, 'submodule_id');
    }

    public function permission()
    {
        return $this->hasOne(Permission::class, 'action_id');
    }

    public function getActionPermissionName()
    {
        $permission = $this->action_name . ' ' . strtolower(str_replace(' ', '_', $this->submodule->submodule_name)) . ' of ' . strtolower(str_replace(' ', '_', $this->submodule->module->module_name));
        return $permission;
    }
}
