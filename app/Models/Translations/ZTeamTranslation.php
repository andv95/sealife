<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZTeamTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
    ];

    protected $fillable = [
        'name', 'position', 'image', 'content'
    ];
}
