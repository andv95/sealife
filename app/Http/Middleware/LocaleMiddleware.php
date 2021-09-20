<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use App\Models\Language;
use Closure;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array(curLocale(), Language::getSupportedLanguageKeys())) {
            return abort(Helper::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
