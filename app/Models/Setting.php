<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\HasLocale;
use App\Models\Traits\ModelBasically;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Setting
 * @package App\Models
 *
 * @property int $type
 * @property int $group
 * @property string $value
 * @property string $key
 * @property boolean language_flg
 */
class Setting extends Model
{
    use ModelBasically, HasLocale;

    public $timestamps = false;

    protected $fillable = [
        'key', 'value', 'display_name', 'type', 'group', "options", "order_no", "language_flg"
    ];

    public $translatedAttributes = ['translated_value'];

    const TYPE_TEXT = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_CK_EDITOR = 3;
    const TYPE_IMAGE = 4;
    const TYPE_MULTI_IMAGES = 5;

    const ALL_TYPES = [
        self::TYPE_TEXT,
        self::TYPE_TEXTAREA,
        self::TYPE_CK_EDITOR,
        self::TYPE_IMAGE,
        self::TYPE_MULTI_IMAGES
    ];

    const GROUP_ALL = 'all';
    const GROUP_ADMIN = 'admin';
    const GROUP_SITE = 'site';
    const GROUP_SITE_HOME = 'site_home';
    const GROUP_SITE_CRUISE = 'site_cruise';
    const GROUP_SITE_PACKAGE = 'site_package';
    const GROUP_SITE_NEWS = 'site_news';
    const GROUP_SITE_INQUIRY = 'site_inquiry';
    const GROUP_SITE_OTHER = 'site_other';

    const ALL_GROUPS = [
        //self::GROUP_ALL,
        //self::GROUP_ADMIN,
        self::GROUP_SITE,
        self::GROUP_SITE_HOME,
        self::GROUP_SITE_CRUISE,
        self::GROUP_SITE_NEWS,
        self::GROUP_SITE_INQUIRY,
        self::GROUP_SITE_OTHER,
        self::GROUP_SITE_PACKAGE,
    ];

    public function getTypeDisplayName()
    {
        if (!$this->type) {
            return "";
        }

        return __("admin_table.settings.option_type_" . $this->type);
    }

    public function getGroupDisplayName()
    {
        if (!$this->group) {
            return "";
        }

        return __("admin_table.settings.option_group_" . $this->group);
    }

    public function hasMultipleLanguages()
    {
        return !!$this->language_flg;
    }

    public function getValue(string $languageKey = null)
    {
        $value = $this->value;

        if ($this->hasMultipleLanguages()) {
            $languageKey = ($languageKey ?? curLocale());

            if ($this->hasTranslation($languageKey)) {
                $value = $this->translate($languageKey)->getAttribute("translated_value");
            }
        }

        return self::getValueByType($this->type, $value);
    }

    public static function getSettingCacheKey(string $languageKey, string $key, string $group = null)
    {
        $group = ($group ?: self::GROUP_ALL);

        return "settings." . $languageKey . "." . $key . "." . $group;
    }

    public static function getValueByKey(string $key, $default = "", string $languageKey = null)
    {
        $keyArray = explode(".", $key);

        if (count($keyArray) > 1) {
            $group = $keyArray[0];
            $realKey = $keyArray[1];
        } else {
            $group = null;
            $realKey = $keyArray[0];
        }

        $cacheKey = self::getSettingCacheKey(($languageKey ?? curLocale()), $realKey, $group);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $setting = self::getEloquentList()
            ->where("key", $realKey)
            ->where("group", $group)
            ->first();

        if (!$setting instanceof self) {
            return $default;
        }

        $value = $setting->getValue();
        Cache::forever($cacheKey, !is_null($value) ? $value : "");

        return $value;
    }

    /**
     * @param $groups
     * @return self[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getByGroups($groups)
    {
        $groups = (is_array($groups) ? $groups : [$groups]);
        $groups = array_filter($groups);

        return self::getEloquentList()
            ->whereIn("group", $groups)
            ->orderBy("order_no", "ASC")
            ->get();
    }

    public static function updateConfigs(array $data)
    {
        $count = 0;

        foreach (self::ALL_GROUPS as $group) {
            if (!array_key_exists($group, $data) || !is_array($data[$group])) {
                break;
            }

            foreach ($data[$group] as $settingKey => $value) {
                //Exist setting key and group ?
                $existSetting = self::getEloquentList()
                    ->where("key", $settingKey)
                    ->where("group", $group)
                    ->first();

                if (!$existSetting instanceof self) {
                    break;
                }

                $storeValue = self::getStoreValueByType(
                    $existSetting->type,
                    $value,
                    $existSetting->hasMultipleLanguages()
                );

                self::storeUpdate($storeValue, $existSetting);

                $count++;
            }
        }

        return $count;
    }

    public static function getStoreValueByType($type, $value, bool $multiLanguages)
    {
        if ($type == self::TYPE_IMAGE || $type == self::TYPE_MULTI_IMAGES) {
            if ($multiLanguages) {
                $result = [];

                foreach ($value as $locale => $params) {
                    $result[$locale]["translated_value"] = Helper::jsonEncode($params["translated_value"]);
                }

                return $result;
            }

            return ["value" => Helper::jsonEncode($value["value"])];
        }

        return $value;
    }

    public static function getValueByType($type, $value)
    {
        if ($type == self::TYPE_IMAGE || $type == self::TYPE_MULTI_IMAGES) {
            $array = @Helper::jsonDecode($value, true);

            return (is_array($array) ? $array : []);
        }

        return $value;
    }
}
