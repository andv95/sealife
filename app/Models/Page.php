<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\HasClone;
use App\Models\Traits\HasLocale;
use App\Models\Traits\HasSeo;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App\Models
 *
 * @property string $fixed_slug
 * @property string $view_name
 */
class Page extends Model
{
    use ModelBasically, HasActiveFlg, HasLocale, HasSeo, HasClone;

    protected $fillable = ['global_name', 'view_name', 'active_flg'];

    public $translatedAttributes = [
        'name', 'slug', 'titles', 'images', 'contents', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    const VIEW_NAMES = ["contact", "about-us", "sustainable", "character-cruise"];

    const PAGE_FIXED_HOME = 'home';
    const PAGE_FIXED_NEWS_TYPE_LIST = 'news-type-list';
    const PAGE_FIXED_SPECIAL_OFFERS = 'special-offers';
    const PAGE_FIXED_SEND_INQUIRY = 'send-inquiry';

    public static function getByFixedSlug($slug)
    {
        return self::getEloquentList()
            ->withTranslation()
            ->where("fixed_slug", $slug)
            ->first();
    }

    public static function getPageBySlug(string $slug = null)
    {
        $page = self::getBySlug($slug);

        return ($page && !$page->isFixedPage()) ? $page : null;
    }

    public function isFixedPage()
    {
        return !!$this->fixed_slug;
    }

    public function hasView()
    {
        return !!$this->view_name;
    }

    public function getViewName()
    {
        $viewName = $this->view_name ?? "default";

        return "site.static_pages.{$viewName}";
    }

    public function getImageUrl($template, $url)
    {
        return Helper::getImageCacheUrl(@$template, @$url);
    }
}
