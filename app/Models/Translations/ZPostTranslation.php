<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZPostTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
        'images' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'excerpt', 'image', 'images', 'description',
        'meta_title', 'meta_keywords', 'meta_description'
    ];
}
