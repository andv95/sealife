<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZDistributorTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'phone', 'email', 'address'
    ];
}
