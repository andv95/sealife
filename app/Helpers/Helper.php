<?php

namespace App\Helpers;

use App\Models\Language;
use Illuminate\Support\Str;

class Helper
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_FORBIDDEN = 403;
    const HTTP_SERVER_ERROR = 500;
    const HTTP_BAD_REQUEST = 422;

    const CACHE_KEY_LANGUAGES = "languages";
    const CACHE_KEY_SETTING = "settings.";

    public static function jsonDecode($json, $assoc = false, $depth = 512, $options = 0)
    {
        return json_decode($json, $assoc, $depth, $options);
    }

    public static function jsonEncode($value, $options = 0, $depth = 512)
    {
        return json_encode($value, $options, $depth);
    }

    public static function getDataInstagramByTag(string $tag)
    {
        $sources = file_get_contents("https://www.instagram.com/explore/tags/{$tag}/");
        $shards = explode('window._sharedData = ', $sources);
        $jsonData = explode(';</script>', $shards[1]);

        return self::jsonDecode($jsonData[0], true);
    }

    public static function getImagesInstagramByTag(string $tag)
    {
        $data = self::getDataInstagramByTag($tag);
        $images = [];

        foreach ($data['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] as $imageData) {
            $imageDataNode = $imageData['node'];

            if (empty($imageDataNode["is_video"])) {
                $images[] = [
                    'display_url' => $imageData['node']['display_url'],
                    'alt' => @$imageData['node']['edge_media_to_caption']['edges'][0]['node']['text'],
                    'caption' => $imageData['node']['accessibility_caption']
                ];
            }
        }

        return $images;
    }

    public static function getImageCacheUrl(string $template, string $url = null)
    {
        if (!$url) {
            return "";
        }

        if (Str::startsWith($url, "/")) {
            $url = Str::replaceFirst("/", "", $url);
        }

        return "/imagecache/{$template}/{$url}";
    }

    public static function getCountriesByLocale(string $locale = null)
    {
        $locale = ($locale ?: Language::getCurrentLanguageKey());

        if ($country = config("site_config.country.{$locale}")) {
            return $country;
        }

        return config("site_config.country." . Language::getDefaultLanguageKey(), []);
    }

    public static function getFormatPrice($price)
    {
        $decPoint = ",";
        $thousandsSep = ".";

        if (Language::getCurrentLanguageKey() === 'en') {
            $decPoint = ".";
            $thousandsSep = ",";
        }

        return number_format((int)$price, 0, $decPoint, $thousandsSep);
    }

    public static function addZeroToNumber($number)
    {
        $number = (int)$number;

        if ($number >= 10) {
            return $number;
        }

        return "0" . $number;
    }
}
