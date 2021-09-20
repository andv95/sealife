<?php


namespace App\Facade;


use App\Cache\StaticRequestCache;
use Illuminate\Support\Facades\Facade;

class CacheStatic extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StaticRequestCache::class;
    }
}
