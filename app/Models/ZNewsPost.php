<?php

namespace App\Models;

use App\Helpers\Helper;

use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasRate;
use App\Models\Traits\HasSeo;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZNewsPost
 * @package App\Models
 *
 * @property ZNewsType[]|Collection $zNewsTypes
 *
 * @property boolean $featured1_flg
 * @property boolean $featured2_flg
 * @property string $slug
 * @property array $image
 */
class ZNewsPost extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasSeo, HasRate, HasClone;

    protected $fillable = ['active_flg', 'global_name', 'featured1_flg', 'featured2_flg'];

    public $translatedAttributes = [
        'name', 'slug', 'image', 'featured1_image', 'featured2_image',
        'excerpt', 'content', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    const NUMBER_POST_PER_ROW = 3;
    const POST_PAGE_SIZE = 9;

    public function isFeatured1()
    {
        return !!$this->featured1_flg;
    }

    public function isFeatured2()
    {
        return !!$this->featured2_flg;
    }

    public function zNewsTypes()
    {
        return $this->belongsToMany(ZNewsType::class, "z_news_post_types");
    }

    public function zPackages()
    {
        return $this->belongsToMany(ZPackage::class, "z_news_post_packages");
    }

    public static function storeUpdateWithRelations(string $locale, array $params, $recordOrId = null)
    {
        $data = self::storeUpdateByLocale($locale, $params, $recordOrId);

        if (array_key_exists("z_news_type_ids", $params)) {
            $data->zNewsTypes()->sync($params["z_news_type_ids"]);
        }

        if (array_key_exists("z_package_ids", $params)) {
            $data->zPackages()->sync($params["z_package_ids"]);
        }

        return $data;
    }

    /**
     * To get latest posts.
     *
     * @param int|null $limit
     * @param array $excerptIds
     * @param bool $isFeatured
     * @return self[]|Collection
     */
    public static function getLatestList(int $limit = null, array $excerptIds = [], bool $isFeatured = false)
    {
        $limit = ($limit ?? self::NUMBER_POST_PER_ROW);

        $posts = self::getEloquentList([], ["zNewsTypes"])
            ->whereNotIn("id", $excerptIds);

        if (!$isFeatured) {
            $posts = $posts
                ->where("featured1_flg", '!=', true)
                ->where("featured2_flg", '!=', true);
        }

        return $posts
            ->translatedIn()
            ->latest()
            ->take($limit)
            ->active()
            ->get();
    }

    public static function getListByTypeIds($typeIds, $exceptIds = [], int $limit = null)
    {
        $typeIds = (is_array($typeIds) ? $typeIds : [$typeIds]);
        $exceptIds = (is_array($exceptIds) ? $exceptIds : [$exceptIds]);
        $limit = (is_numeric($limit) && $limit > 0 ? $limit : self::NUMBER_POST_PER_ROW);

        return self::getEloquentList([], ["zNewsTypes"])
            ->whereNotIn("id", array_filter($exceptIds))
            ->whereHas("zNewsTypes", function ($query) use ($typeIds) {
                $query->whereIn("id", array_filter($typeIds));
            })
            ->translatedIn()
            ->latest()
            ->take($limit)
            ->active()
            ->get();
    }

    public static function getFeaturedPost(int $number)
    {
        $number = (in_array($number, [1, 2]) ? $number : 1);

        return self::getEloquentList([], ["zNewsTypes"])
            ->where("featured{$number}_flg", true)
            ->translatedIn()
            ->latest()
            ->active()
            ->first();
    }

    public function getDetailUrl()
    {
        return localeRoute("news_posts.detail", ['slug' => $this->slug]);
    }

    public function getImageUrl(bool $large = false)
    {
        if ($large) {
            return Helper::getImageCacheUrl("large-news-post-item", @$this->image['url']);
        }

        return Helper::getImageCacheUrl("news-post-item", @$this->image['url']);
    }

    public function getZNewsType()
    {
        return $this->zNewsTypes->first();
    }

    public function getRelatedPackages()
    {
        return $this->zPackages()
            ->translatedIn()
            ->active()
            ->orderBy("order_no", "asc")
            ->latest()
            ->take(3)
            ->get();
    }

    public static function getEloquentFilter($query, $params = [])
    {
        if (isset($params['category_id'])) {
            $query = $query->whereHas("zNewsTypes", function ($query1) use ($params) {
                $query1->where("id", $params['category_id']);
            });
        }

        return $query;
    }
}
