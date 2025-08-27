<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomRole as Role;

class Organization extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'org_id';
    protected $fillable = [
        'org_name',
        'org_description',
        'org_logo',
        'org_status',
        'org_color',
    ];

    public function roles()
    {
        return $this->hasMany(Role::class, 'org_id'); // Ensure 'org_id' matches the column in roles table
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_id');
    }


}
