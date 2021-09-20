<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZCruiseTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
        'key_facts' => 'array'
    ];

    protected $fillable = [
        'name', 'slug', 'excerpt', 'excerpt_show_mobile', 'image', 'images', 'description', 'sub_name', 'long_name', 'key_facts',
        'meta_title', 'meta_keywords', 'meta_description'
    ];
}
