<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class ZBannerTranslation extends Model
{
    public $timestamps = false;

    protected $casts = [
        'images' => 'array',
        'images_mobile' => 'array'
    ];

    protected $fillable = [
        'images', 'images_mobile', 'video_url', 'video_url_mobile', 'view_more_url'
    ];
}
