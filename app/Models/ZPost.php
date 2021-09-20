<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZPost
 * @package App\Models
 *
 * @property array $image
 */
class ZPost extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'type'];

    public $translatedAttributes = [
        'name', 'slug', 'excerpt', 'image', 'images', 'description',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    const TYPE_EXPERIENCE = 1;
    const TYPE_ACTIVITY = 2;

    const TYPES = [
        self::TYPE_EXPERIENCE,
        self::TYPE_ACTIVITY
    ];

    public static function getListByType($type)
    {
        return self::getEloquentList()
            ->where("type", $type)
            ->get();
    }

    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("post-item", @$this->image['url']);
    }
}
