<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\Translations\MenuItemTranslation;
use App\Models\Translations\SettingTranslation;
use App\Observers\LanguageObserver;
use App\Observers\MenuItemObserver;
use App\Observers\MenuItemTranslationObserver;
use App\Observers\MenuObserver;
use App\Observers\SettingObserver;
use App\Observers\SettingTranslationObserver;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Setting::observe(SettingObserver::class);
        SettingTranslation::observe(SettingTranslationObserver::class);

        Language::observe(LanguageObserver::class);

        Menu::observe(MenuObserver::class);
        MenuItem::observe(MenuItemObserver::class);
        MenuItemTranslation::observe(MenuItemTranslationObserver::class);
    }
}
