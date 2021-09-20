<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZDurationTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'short_name'];
}
