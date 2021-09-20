<?php

namespace App\Http\Middleware;

use App\Facade\CacheStatic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Cache\StaticRequestCache;

class CacheMiddleware
{
    protected $staticRequestCache;

    public function __construct(StaticRequestCache $staticRequestCache)
    {
        $this->staticRequestCache = $staticRequestCache;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $access = CacheStatic::accessCache($request) && !$response->headers->get('cache-file', false);
        if ($access) {
            $store = function () use ($request, $response) {
                if ($this->staticRequestCache->shouldStoreResponse($request, $response)) {
                    $this->staticRequestCache->store($request, $response);
                }
            };

            if (config('site_config.static_cache.graceful')) {
                rescue($store);
            } else {
                $store();
            }
        }
    }
}
