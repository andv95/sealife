<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZPopularKeyTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'url'
    ];
}
