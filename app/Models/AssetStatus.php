<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetStatus extends Model
{
    use SoftDeletes;
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
