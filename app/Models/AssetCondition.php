<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCondition extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'condition_id';

    protected $fillable = [
        'condition_name',
        'condition_description',
    ];

     public function assets()
    {
        return $this->hasMany(Asset::class,'condition_id');
    }
}
