<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZRoomTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
        'images' => 'array',
        'key_facts' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'key_facts', 'image', 'images', 'size', 'price',
        'meta_title', 'meta_keywords', 'meta_description'
    ];
}
