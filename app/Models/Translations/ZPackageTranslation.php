<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZPackageTranslation extends Model
{
    public $timestamps = false;

    public $casts = [
        'itinerary' => 'array',
        'images' => 'array',
        'image' => 'array',
        'itinerary_bg_image' => 'array',
    ];

    protected $fillable = [
        'name', 'slug', 'image', 'images', 'itinerary', 'itinerary_bg_image', 'itinerary_file', 'price_inclusion', 'price_exclusion',
        'cruise_policy', 'booking_policy',
        'meta_title', 'meta_keywords', 'meta_description'
    ];
}
