<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasSeo;
use App\Models\Traits\HasShowHome;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZCruise
 * @package App\Models
 *
 * @property ZRoom[] $zRooms
 * @property ZProperty $zProperty
 * @property ZRoom[] $zRoomsActive
 * @property ZProperty $zPropertyActive
 * @property ZPost[] $zPostsActive
 * @property ZPackage[] $zPackagesActive
 *
 * @property string $slug
 * @property array $key_facts
 * @property array $image
 */
class ZCruise extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasShowHome, HasSeo, HasClone;

    protected $fillable = ['global_name', 'active_flg', 'z_property_id', 'home_flg'];

    public $translatedAttributes = [
        'name', 'slug', 'excerpt', 'excerpt_show_mobile', 'image', 'images', 'description', 'sub_name', 'long_name', 'key_facts',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function zProperty()
    {
        return $this->belongsTo(ZProperty::class);
    }

    public function zPackages()
    {
        return $this->hasMany(ZPackage::class);
    }

    public function zRooms()
    {
        return $this->hasMany(ZRoom::class);
    }

    public function zPosts()
    {
        return $this->belongsToMany(ZPost::class, "z_cruise_posts");
    }

    public function zPackagesActive()
    {
        return $this->zPackages()
            ->with(['zDuration', 'zDurationActive', 'zOffersActive'])
            ->withTranslation()
            ->active()
            ->orderBy("order_no", "asc")
            ->latest();
    }

    public function zRoomsActive()
    {
        return $this->zRooms()->withTranslation()->active()->latest();
    }

    public function zPostsActive()
    {
        return $this->zPosts()->withTranslation()->active()->latest();
    }

    public function zPropertyActive()
    {
        return $this->zProperty()->withTranslation()->active();
    }

    public function getKeyFacts()
    {
        return $this->key_facts;
    }

    public static function storeUpdateWithRelations(string $locale, array $params, $recordOrId = null)
    {
        $data = self::storeUpdateByLocale($locale, $params, $recordOrId);

        if (array_key_exists("z_post_ids", $params)) {
            $data->zPosts()->sync($params["z_post_ids"]);
        }

        return $data;
    }

    public function getDetailUrl()
    {
        return localeRoute("cruises.detail", ['slug' => $this->slug]);
    }

    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("cruise-item", @$this->image['url']);
    }
}
