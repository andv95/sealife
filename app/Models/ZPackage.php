<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasSeo;
use App\Models\Traits\ModelBasically;
use App\Services\CrsApiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as BaseCollection;

/**
 * Class ZPackage
 * @package App\Models
 *
 * @property ZDestination[]|Collection $zDestinations
 * @property ZDestination[]|Collection $zDestinationsActive
 * @property ZOffer[]|Collection $zOffers
 * @property ZOffer[]|Collection $zOffersActive
 * @property ZPost[]|Collection $zPosts
 * @property ZPost[]|Collection $zPostsActive
 * @property ZReview[]|Collection $zReviewsActive
 * @property ZTransfer[]|Collection $zTransfersActive
 * @property ZDuration $zDurationActive
 *
 * @property array $images
 * @property array $image
 * @property array $itinerary
 * @property string $slug
 * @property string $api_id
 * @property string $name
 */
class ZPackage extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasSeo, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'z_cruise_id', 'z_duration_id', "api_id", "order_no"];

    public $translatedAttributes = [
        'name', 'slug', 'image', 'images', 'itinerary', 'itinerary_bg_image', 'itinerary_file', 'price_inclusion', 'price_exclusion',
        'cruise_policy', 'booking_policy',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    private $apiMinPriceArray;
    private $apiMinPriceByDateArray = [];
    private $apiRoomsByDate = [];
    private $apiInfo;
    private $crsApi;

    protected $with = ['zDuration'];

    public function zCruise()
    {
        return $this->belongsTo(ZCruise::class);
    }

    public function zDuration()
    {
        return $this->belongsTo(ZDuration::class)->withTranslation();
    }

    public function zDestinations()
    {
        return $this->belongsToMany(ZDestination::class, "z_package_destinations");
    }

    public function zOffers()
    {
        return $this->belongsToMany(ZOffer::class, "z_package_offers");
    }

    public function zPosts()
    {
        return $this->belongsToMany(ZPost::class, "z_package_posts");
    }

    public function zReviews()
    {
        return $this->belongsToMany(ZReview::class, "z_package_reviews");
    }

    public function zSpecialOffers()
    {
        return $this->belongsToMany(ZSpecialOffer::class, "z_package_special_offers");
    }

    public function zTransfers()
    {
        return $this->belongsToMany(ZTransfer::class, "z_package_transfers");
    }

    public function zDurationActive()
    {
        return $this->zDuration()->withTranslation()->active();
    }

    public function zDestinationsActive()
    {
        return $this->zDestinations()->withTranslation()->active();
    }

    public function zOffersActive()
    {
        return $this->zOffers()->withTranslation()->active();
    }

    public function zPostsActive()
    {
        return $this->zPosts()->withTranslation()->where("type", ZPost::TYPE_ACTIVITY)->active();
    }

    public function zReviewsActive()
    {
        return $this->zReviews()->withTranslation()->active();
    }

    public function zSpecialOffersActive()
    {
        return $this->zSpecialOffers()->withTranslation()->active();
    }

    public function zTransfersActive()
    {
        return $this->zTransfers()->withTranslation()->active()->orderBy("order_no", "asc");
    }

    public static function storeUpdateWithRelations(string $locale, array $params, $recordOrId = null)
    {
        $data = self::storeUpdateByLocale($locale, $params, $recordOrId);

        if (array_key_exists("z_offer_ids", $params)) {
            $data->zOffers()->sync($params["z_offer_ids"]);
        }

        if (array_key_exists("z_destination_ids", $params)) {
            $data->zDestinations()->sync($params["z_destination_ids"]);
        }

        if (array_key_exists("z_post_ids", $params)) {
            $data->zPosts()->sync($params["z_post_ids"]);
        }

        if (array_key_exists("z_special_offer_ids", $params)) {
            $data->zSpecialOffers()->sync($params["z_special_offer_ids"]);
        }

        return $data;
    }

    /**
     * To get images.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getImages()
    {
        $images = $this->images;
        $images = collect($images);

        return $images->sortBy("order_no");
    }

    public function getItineraries()
    {
        $itinerary            = $this->itinerary;
        $itineraries["title"] = (@$itinerary["title"] ?? "");
        $itineraries["list"]  = (is_array(@$itinerary["list"]) ? $itinerary["list"] : []);

        return $itineraries;
    }

    public function getDetailUrl(array $params = [])
    {
        return localeRoute("packages.detail", array_merge($params, ['slug' => $this->slug]));
    }

    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("package-item", @$this->image['url']);
    }

    /**
     * @param int|null $page
     * @param int $pageSize
     * @return ZReview[]|Collection
     */
    public function getZReviewsPaginate(int $page = null, int $pageSize = 2)
    {
        $page = ($page > 1 ? $page : 1);

        return $this->zReviewsActive()
            ->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();
    }

    public static function getPackagesFilter(array $params = [])
    {
        $query = self::getEloquentList();

        if (array_key_exists("destination_ids", $params) && $params["destination_ids"]) {
            $query = $query->whereHas("zDestinationsActive", function ($query) use ($params) {
                $query->whereIn("id", $params["destination_ids"]);
            });
        }

        if (array_key_exists("duration_ids", $params) && $params["duration_ids"]) {
            $query = $query->whereHas("zDurationActive", function ($query) use ($params) {
                $query->whereIn("id", $params["duration_ids"]);
            });
        }

        if (array_key_exists("special_offer_ids", $params) && $params["special_offer_ids"]) {
            $query = $query->whereHas("zSpecialOffersActive", function ($query) use ($params) {
                $query->whereIn("id", $params["special_offer_ids"]);
            });
        }

        return $query
            ->active()
            ->orderBy("order_no", "asc")
            ->latest()
            ->get();
    }

    public static function getApiIds()
    {
        $api = (new self)->getCrsApi();

        return collect($api->getApiIdsByModule(CrsApiService::API_FIELD_PACKAGE));
    }

    public function getApiMinPrice()
    {
        if (is_null($this->apiMinPriceArray)) {
            $api      = $this->getCrsApi();
            $prices   = $api->getPackagePriceMinRooms($this->api_id);
            $minPrice = $this->getMinPriceInPrices($prices);

            $this->apiMinPriceArray = $this->convertToPriceArray($minPrice);
        }

        return $this->apiMinPriceArray;
    }

    public function getMinPriceText()
    {
        return $this->getPriceTextDisplay($this->getApiMinPrice());
    }

    public function getMinPriceNoPromotionText(string $date = null)
    {
        return $this->getPriceTextDisplay($this->getMinPriceByDate($date), true);
    }

    public function getApiRoomsByDate(string $date)
    {
        if (!array_key_exists($date, $this->apiRoomsByDate)) {
            $api                         = $this->getCrsApi();
            $this->apiRoomsByDate[$date] = $api->getPackageRooms($this->api_id, $date);
        }

        return $this->apiRoomsByDate[$date];
    }

    public function getApiRoomsByDateWithZRoom(string $date = null)
    {
        $roomsWithZRoom = collect([]);

        if (is_null($date)) {
            $zRoomApiIds = $this->getApiRoomIds();
            $zRooms      = ZRoom::getListByApiIds($zRoomApiIds);
        } else {
            $rooms       = collect($this->getApiRoomsByDate($date));
            $zRoomApiIds = $rooms->pluck("room_id")->toArray();
            $zRooms      = ZRoom::getListByApiIds($zRoomApiIds);
        }

        foreach ($zRooms as $zRoom) {
            if (isset($rooms)) {
                $room = $rooms->filter(function ($dataRoom) use ($zRoom) {
                    return $dataRoom['room_id'] === $zRoom->api_id;
                })->first();
            }

            $room["z_room"] = $zRoom;

            $roomsWithZRoom->push($room);
        }

        return $roomsWithZRoom;
    }

    public function getMinPriceByDate($date)
    {
        if (is_null($date)) {
            return $this->getApiMinPrice();
        }

        if (!array_key_exists($date, $this->apiMinPriceByDateArray)) {
            $prices   = $this->getApiRoomsByDate($date);
            $minPrice = $this->getMinPriceInPrices($prices);

            $this->apiMinPriceByDateArray[$date] = $this->convertToPriceArray($minPrice);
        }

        return $this->apiMinPriceByDateArray[$date];
    }

    public function getMinPriceByDateText($date, $wasPrice = false)
    {
        return $this->getPriceTextDisplay($this->getMinPriceByDate($date), $wasPrice);
    }

    private function getMinPriceInPrices(array $prices)
    {
        if (!count($prices)) {
            return [];
        }

        $prices   = BaseCollection::make($prices);
        $minPrice = $prices->min("price");

        return $prices->filter(function ($price) use ($minPrice) {
            return $price['price'] == $minPrice;
        })->first();
    }

    public function getPriceTextDisplay(array $prices, $wasPrice = false)
    {
        $field = ($wasPrice ? "wasPrice" : "price");

        if (empty($prices[$field])) {
            return $wasPrice ? null : __("site_global.label_price_contact_us");
        }

        $priceText = Helper::getFormatPrice($prices[$field]);

        $displayText = "<span>{$prices['prefix']}</span>";
        $displayText .= "<span>{$priceText}</span>";
        $displayText .= "<span>{$prices['unit']}</span>";

        return $displayText;
    }

    private function convertToPriceArray($roomApi)
    {
        $roomApi              = (is_array($roomApi) ? $roomApi : []);
        $results["price"]     = (array_key_exists("price", $roomApi) ? $roomApi["price"] : "");
        $results["unit"]      = (array_key_exists("unit", $roomApi) ? $roomApi["unit"] : "");
        $results["prefix"]    = (array_key_exists("price_prefix", $roomApi) ? $roomApi["price_prefix"] : "");
        $results["roomApiId"] = (array_key_exists("room_id", $roomApi) ? $roomApi["room_id"] : "");
        $results["roomDesc"]  = (array_key_exists("desc", $roomApi) ? $roomApi["desc"] : "");

        $results["wasPrice"] = $results["price"];

        if (array_key_exists("promotion", $roomApi)) {
            $results["price"] = $roomApi["promotion"]["price"];
        }

        $zRoom            = ZRoom::getListByApiIds($results["roomApiId"])->first();
        $zRoom            = ($zRoom && $zRoom->hasTranslation() ? $zRoom : null);
        $results["zRoom"] = $zRoom;

        return $results;
    }

    public function getApiInfo()
    {
        if (is_null($this->apiInfo)) {
            $api           = $this->getCrsApi();
            $this->apiInfo = $api->getPackageInfo($this->api_id);
        }

        return $this->apiInfo;
    }

    public function getApiRoomIds()
    {
        $info = $this->getApiInfo();

        if (array_key_exists("rooms", $info)) {
            return $info["rooms"];
        }

        return [];
    }

    public function getApiInfoByRoomIdAndDateWithZRoom($roomId, string $date)
    {
        $zRoom = ZRoom::getListByApiIds($roomId)->first();

        if (!$zRoom || !$zRoom->hasTranslation()) {
            return false;
        }

        $api  = $this->getCrsApi();
        $info = $api->getPackageRooms($this->api_id, $date, ["room_id" => $roomId]);

        return isset($info[0]) ? array_merge($info[0], ["z_room" => $zRoom]) : false;
    }

    /**
     * To get Api service
     *
     * @return CrsApiService
     */
    private function getCrsApi()
    {
        if (is_null($this->crsApi)) {
            $this->crsApi = new CrsApiService();
        }

        return $this->crsApi;
    }
}
