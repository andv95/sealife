<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZDestinationTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'image', 'images', 'description', 'summary',
        'meta_title', 'meta_keywords', 'meta_description'
    ];
}
