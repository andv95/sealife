<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'titles' => 'array',
        'images' => 'array',
        'contents' => 'array',
    ];

    protected $fillable = [
        'name', 'slug', 'titles', 'images', 'contents', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
