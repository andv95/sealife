<?php

namespace App\Observers;

use App\Models\Translations\SettingTranslation;

class SettingTranslationObserver
{
    public function saved(SettingTranslation $settingTranslation)
    {
        if ($setting = $settingTranslation->setting) {
            (new SettingObserver())->forgetSettingByLocale(
                $settingTranslation->locale,
                $setting->key,
                $setting->group
            );
        }
    }

    public function deleting(SettingTranslation $settingTranslation)
    {
        if ($setting = $settingTranslation->setting) {
            (new SettingObserver())->forgetSettingByLocale(
                $settingTranslation->locale,
                $setting->key,
                $setting->group
            );
        }
    }
}
