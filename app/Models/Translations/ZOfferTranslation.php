<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZOfferTranslation extends Model
{
    public $timestamps = false;

    public $casts = [
        'image' => 'array'
    ];

    protected $fillable = ['name', 'image'];
}
