<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZNewsTypeTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
        'banner_image' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'image', 'banner_image', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
