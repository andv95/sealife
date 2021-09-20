<?php

namespace App\Observers;

use App\Helpers\Helper;
use App\Models\Language;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
    public function saved(Language $setting)
    {
        $this->reCache();
    }

    public function deleted(Language $setting)
    {
        $this->reCache();
    }

    public function reCache()
    {
        Cache::forget(Helper::CACHE_KEY_LANGUAGES);

        //ReCache.
        Language::getSupportedLanguages();
    }
}
