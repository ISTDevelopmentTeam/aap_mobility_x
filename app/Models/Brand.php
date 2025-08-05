<?php

namespace App\Models;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'brand_name',
    ];

    // Relationship: A brand has many IT or Mobile Device assets
    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'brand_id')
            ->whereIn('category_id', [1, 6]); // 1: IT EQUIPMENT, 6: MOBILE DEVICES
    }
}
