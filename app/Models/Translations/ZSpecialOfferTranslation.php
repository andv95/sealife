<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZSpecialOfferTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'short_desc', 'invalid_desc'
    ];
}
