<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'action_id';
    protected $fillable = [
        'action_name',
        'action_description',
        'action_status',
        'submodule_id',
    ];

    // Belongs to a Module
    public function submodule()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function getActionPermissionName($actionType)
    {
        $permission = $actionType . ' ' . strtolower(str_replace(' ', '_', $this->submodule->submodule_name)) . ' of ' . strtolower(str_replace(' ', '_', $this->submodule->module->module_name));
        return $permission;
    }
}
