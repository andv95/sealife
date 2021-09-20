<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZGallery
 * @package App\Models
 *
 * @property string $video_url
 * @property array $image
 */
class ZGallery extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale;

    protected $fillable = ['global_name', 'active_flg', 'z_gallery_type_id'];

    public $translatedAttributes = [
        'images', 'images_mobile'
    ];

    public function zGalleryType()
    {
        return $this->belongsTo(ZGalleryType::class, "z_gallery_type_id");
    }

    public function getUrl(array $image)
    {
        if ($this->isVideo($image)) {
            return $image['video_url'] . '?autoplay=1&loop=1';
        }

        return @$image['url'];
    }

    public function isVideo(array $image)
    {
        return !empty($image['video_url']);
    }

    public function getUrlImage(array $image, $isBig = false)
    {
        return Helper::getImageCacheUrl($isBig ? 'gallery-big-item' : 'gallery-item', @$image['url']);
    }
}
