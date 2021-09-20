<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZGalleryTypeTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
