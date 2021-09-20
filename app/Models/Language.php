<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasActiveFlg;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Language
 * @package App\Models
 *
 * @property string $language_key
 * @property string $native_name
 * @property string $latin_name
 * @property string $regional
 * @property string $script
 */
class Language extends Model
{
    use ModelBasically, HasActiveFlg;

    protected $fillable = [
        'language_key', 'remark', 'native_name', 'latin_name', 'script', 'regional', 'active_flg', 'order_no'
    ];

    const PRE_URL_CRUISE = "cruises";
    const PRE_URL_NEWS_POST = "news-posts";

    public function getLanguageKey(): string
    {
        return $this->language_key;
    }

    public function getName(): string
    {
        return $this->getLanguageKey() . " - " . $this->native_name;
    }

    public function isDefaultLanguageKey(): bool
    {
        return $this->getLanguageKey() === self::getDefaultLanguageKey();
    }

    public static function getDefaultLanguageKey(): string
    {
        return config('app.default_language') ?: 'vi';
    }

    public static function getCurrentLanguageKey(): string
    {
        return app()->getLocale();
    }

    public static function getBuilderLanguages()
    {
        return self::getEloquentList()
            ->orderBy("order_no", "asc");
    }

    /**
     * To get all languages (cache).
     *
     * @return self[]|Collection
     */
    public static function getLanguages()
    {
        $cacheKey = Helper::CACHE_KEY_LANGUAGES;

        //Cache ?
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $languages = self::getBuilderLanguages()->get();

        //Cache
        Cache::forever($cacheKey, $languages);

        return $languages;
    }

    /**
     * To get all languages active (cache).
     *
     * @return self[]|Collection
     */
    public static function getSupportedLanguages()
    {
        return self::getLanguages()
            ->filter(function ($language) {
                /**
                 * @var self $language
                 */
                return $language->isActive();
            });
    }

    public static function getSupportedLocales(): array
    {
        $locales = [];

        foreach (self::getSupportedLanguages() as $language) {
            $locales[$language->getLanguageKey()] = [
                'name' => $language->latin_name,
                'script' => $language->script,
                'native' => $language->native_name,
                'regional' => $language->regional
            ];
        }

        return $locales;
    }

    public static function getSupportedLanguageKeys(): array
    {
        return array_keys(self::getSupportedLocales());
    }

    public static function getPackageLocales(): array
    {
        return [
            'de' => ['name' => 'German', 'script' => 'Latn', 'native' => 'Deutsch', 'regional' => 'de_DE'],
            'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
            'es' => ['name' => 'Spanish', 'script' => 'Latn', 'native' => 'español', 'regional' => 'es_ES'],
            'fr' => ['name' => 'French', 'script' => 'Latn', 'native' => 'français', 'regional' => 'fr_FR'],
            'it' => ['name' => 'Italian', 'script' => 'Latn', 'native' => 'italiano', 'regional' => 'it_IT'],
            'pt' => ['name' => 'Portuguese', 'script' => 'Latn', 'native' => 'português', 'regional' => 'pt_PT'],
            'vi' => ['name' => 'Vietnamese', 'script' => 'Latn', 'native' => 'Tiếng Việt', 'regional' => 'vi_VN'],
            'ja' => ['name' => 'Japanese', 'script' => 'Jpan', 'native' => '日本語', 'regional' => 'ja_JP'],
            'zh' => ['name' => 'Chinese (Simplified)', 'script' => 'Hans', 'native' => '简体中文', 'regional' => 'zh_CN'],
            'ko' => ['name' => 'Korean', 'script' => 'Hang', 'native' => '한국어', 'regional' => 'ko_KR'],
        ];
    }

    public static function getPackageLanguageKeys(): array
    {
        return array_keys(self::getPackageLocales());
    }

    public static function getTranslatedUrlOfCurrentUrl(string $locale): string
    {
        $routeName = request()->route() ? request()->route()->getName() : '';

        if ($routeName === "site.locale.cruises.detail") {
            $slug = request()->route("slug");
            $zCruise = ZCruise::getBySlug($slug);

            if ($zCruise && ($zCruiseTranslated = $zCruise->translate($locale))) {
                return "/" . self::PRE_URL_CRUISE . "/" . $zCruiseTranslated->getAttribute("slug");
            }
        } elseif ($routeName === "site.locale.news_posts.detail") {
            $slug = request()->route("slug");
            $zNewsPost = ZNewsPost::getBySlug($slug);

            if ($zNewsPost && ($zNewsPostTranslated = $zNewsPost->translate($locale))) {
                return "/" . self::PRE_URL_NEWS_POST . "/" . $zNewsPostTranslated->getAttribute("slug");
            }
        }

        return "/";
    }
}
