<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    protected $primaryKey = "status_id";

    protected $fillable = [
        "status_name",
        "status_description",
    ];

    // Relationship with Asset
    public function assets(){
        return $this->hasMany(Asset::class,foreignKey:"status_id");
    }
}
