<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCategory extends Model
{
    use SoftDeletes;
    protected $primaryKey = "category_id";

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    // Relationship with Asset
    public function assets()
    {
        return $this->hasMany(Asset::class, 'category_id');
    }
}
