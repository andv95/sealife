<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZNewsPostTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
        'featured1_image' => 'array',
        'featured2_image' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'image', 'featured1_image', 'featured2_image',
        'excerpt', 'content', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
