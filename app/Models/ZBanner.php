<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZBanner
 * @package App\Models
 *
 * @property int $type
 * @property int $type_model_id
 */
class ZBanner extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['type_model_id', 'type', 'global_name', 'active_flg'];

    public $translatedAttributes = [
        'images', 'images_mobile', 'video_url', 'video_url_mobile', 'view_more_url'
    ];

    const TYPE_HOME = 1;
    const TYPE_CRUISE = 2;
    const TYPE_CHARACTER = 3;
    const TYPE_THANK_YOU = 4;
    const TYPES = [
        self::TYPE_HOME,
        self::TYPE_CRUISE,
        self::TYPE_CHARACTER,
        self::TYPE_THANK_YOU
    ];

    /**
     * @param $type
     * @param $typeModelId
     * @return self|null
     */
    public static function getListActiveByType($type, $typeModelId = null)
    {
        $list = self::getEloquentList()
            ->withTranslation()
            ->where('type', $type)
            ->latest()
            ->active();

        if ($typeModelId) {
            $list = $list->where("type_model_id", $typeModelId);
        }

        return $list->first();
    }

    public static function getTypeModelOptionsByType($type, $selectedId)
    {
        if (!in_array($type, self::TYPES)) {
            $type = self::TYPE_HOME;
        }

        $data = [];

        if ($type == self::TYPE_CRUISE) {
            $zCruises = ZCruise::getList();

            foreach ($zCruises as $zCruise) {
                $data[] = [
                    "id" => $zCruise->getKey(),
                    "text" => $zCruise->global_name,
                    "selected" => ($selectedId == $zCruise->getKey())
                ];
            }
        }

        return $data;
    }

    public function getImageUrl(string $url = null)
    {
        return Helper::getImageCacheUrl("banner-full", $url);
    }

    public function getTypeModel()
    {
        if ($this->type == self::TYPE_CRUISE) {
            return ZCruise::getById($this->type_model_id);
        }

        return null;
    }

    public function getTypeModelName()
    {
        if (($this->type == self::TYPE_CRUISE) && ($zCruise = $this->getTypeModel())) {
            return $zCruise->global_name;
        }

        return "";
    }
}
