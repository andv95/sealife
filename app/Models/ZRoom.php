<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use App\Services\CrsApiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZRoom
 * @package App\Models
 *
 * @property array $key_facts
 * @property array $image
 */
class ZRoom extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'max_guest_no', 'z_cruise_id', 'api_id'];

    public $translatedAttributes = [
        'name', 'slug', 'key_facts', 'image', 'images', 'size', 'price',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function zCruise()
    {
        return $this->belongsTo(ZCruise::class);
    }

    public function getKeyFacts()
    {
        return $this->key_facts;
    }

    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("room-item", @$this->image['url']);
    }

    public static function getApiIds()
    {
        $api = new CrsApiService();

        return collect($api->getApiIdsByModule(CrsApiService::API_FIELD_ROOM));
    }

    /**
     * To get list by api ids.
     *
     * @param $apiIds
     * @return self[]|Collection
     */
    public static function getListByApiIds($apiIds)
    {
        $apiIds = (is_array($apiIds) ? $apiIds : [$apiIds]);

        return self::getEloquentList()
            ->whereIn("api_id", $apiIds)
            ->active()
            ->get();
    }
}
