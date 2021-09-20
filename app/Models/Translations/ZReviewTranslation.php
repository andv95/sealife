<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZReviewTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'image' => 'array',
    ];

    protected $fillable = [
        'name', 'author', 'rating', 'image', 'review_date', 'content'
    ];
}
