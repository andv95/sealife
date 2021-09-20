<?php

namespace App\Observers;

use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    public function updated(Setting $setting)
    {
        $key = $setting->key;

        if ($setting->isDirty("key")) {
            $key = $setting->getOriginal("key");
        }

        $this->forgetSetting($key, $setting->group);
    }

    public function deleted(Setting $setting)
    {
        $this->forgetSetting($setting->key, $setting->group);
    }

    public function forgetSetting($key, $group)
    {
        foreach (Language::getSupportedLanguageKeys() as $locale) {
            $this->forgetSettingByLocale($locale, $key, $group);
        }
    }

    public function forgetSettingByLocale(string $locale, $key, $group)
    {
        $cacheKey = Setting::getSettingCacheKey($locale, $key, $group);
        Cache::forget($cacheKey);
    }
}
