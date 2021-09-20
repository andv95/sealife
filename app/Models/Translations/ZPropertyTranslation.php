<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZPropertyTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'excerpt', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
