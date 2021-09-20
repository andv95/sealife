<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZGalleryTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'images' => 'array',
        'images_mobile' => 'array'
    ];

    protected $fillable = [
        'images', 'images_mobile'
    ];
}
