<?php

namespace App\Observers;

use App\Models\Language;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    public function updated(Menu $menu)
    {
        $menuName = $menu->name;

        if ($menu->isDirty("name")) {
            $menuName = $menu->getOriginal("name");
        }

        $this->forgetSetting($menuName);
    }

    public function deleted(Menu $menu)
    {
        $this->forgetSetting($menu->name);
    }

    public function forgetSetting($menuName)
    {
        foreach (Language::getSupportedLanguageKeys() as $locale) {
            $this->forgetSettingByLocale($locale, $menuName);
        }
    }

    public function forgetSettingByLocale(string $locale, $menuName)
    {
        $cacheKey = Menu::getMenuCacheKey($menuName, $locale);
        Cache::forget($cacheKey);
    }
}
