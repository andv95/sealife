<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasSeo;
use App\Models\Traits\ModelBasically;
use App\Models\Traits\HasActiveFlg;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZNewsType
 * @package App\Models
 *
 * @property ZNewsType $zNewsType
 * @property ZNewsType[]|Collection $zNewsTypesChildren
 *
 * @property string $slug
 * @property array $image
 */
class ZNewsType extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasSeo, HasClone;

    protected $fillable = ['active_flg', 'global_name', 'order_no', 'parent_id'];

    public $translatedAttributes = ['name', 'slug', 'image', 'banner_image', 'meta_title', 'meta_keywords', 'meta_description'];

    public function zNewsType()
    {
        return $this->belongsTo(self::class, "parent_id");
    }

    public function zNewsTypes()
    {
        return $this->hasMany(self::class, "parent_id");
    }

    public function zNewsPosts()
    {
        return $this->belongsToMany(ZNewsPost::class, "z_news_post_types");
    }

    public function zNewsTypesChildren()
    {
        return $this->zNewsTypes()
            ->with("zNewsType")
            ->latest()
            ->active();
    }

    public function zNewsPostsLatest(array $excerptIds = [], int $page = 1, int $pageSize = null)
    {
        $pageSize = ($pageSize ?? ZNewsPost::NUMBER_POST_PER_ROW);
        $skip = ($page - 1) * $pageSize;

        return $this->zNewsPosts()
            ->whereNotIn("id", $excerptIds)
            ->latest()
            ->active()
            ->with("zNewsTypes")
            ->skip($skip)
            ->take($pageSize);
    }

    public function getPostListPaginate(int $page = null, int $pageSize = null)
    {
        $page = ((int)$page > 1 ? $page : 1);
        $childrenIds = $this->zNewsTypesChildren->pluck("id")->toArray();
        $pageSize = ($pageSize ?? ZNewsPost::NUMBER_POST_PER_ROW);

        if (count($childrenIds)) {
            $skip = ($page - 1) * $pageSize;

            return ZNewsPost::getEloquentList()
                ->whereHas("zNewsTypes", function ($query) use ($childrenIds) {
                    $query->whereIn("id", array_merge($childrenIds, [$this->getKey()]))
                        ->active();
                })
                ->translatedIn()
                ->latest()
                ->active()
                ->with("zNewsTypes")
                ->skip($skip)
                ->take($pageSize)
                ->get();
        }

        return $this->zNewsPostsLatest([], $page, $pageSize)->get();
    }

    public static function getShowList()
    {
        return self::getEloquentList([], ["zNewsTypesChildren"])
            ->whereNull('parent_id')
            ->active()
            ->orderBy("order_no", "asc")
            ->get();
    }

    public function getDetailUrl()
    {
        return localeRoute("news_types.detail", ['slug' => $this->slug]);
    }

    public function isCurrentUrl()
    {
        $currentUrl = request()->url();

        if ($this->getDetailUrl() == $currentUrl) {
            return true;
        }

        $parent = $this->zNewsType;

        if ($parent && ($parent->getDetailUrl() == $currentUrl)) {
            return true;
        }

        return false;
    }

    public function getImageUrl()
    {
        return Helper::getImageCacheUrl("news-type-item", @$this->image['url']);
    }
}
