<?php

namespace App\Cache;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class StaticRequestCache
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;

        if (config('site_config.static_cache.enabled') === 'debug') {
            $this->enabled = !config('app.debug');
        } else {
            $this->enabled = config('site_config.static_cache.enabled');
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return bool
     */
    public function shouldStoreResponse(Request $request, Response $response): bool
    {
        $isGETRequest = $request->getMethod() === 'GET';
        //$hasNoParams = count($request->input()) === 0;
        $contentTypeData         = $this->getContentTypeFromResponse($response);
        $hasIndexPhpInRequestUri = Str::contains($request->getRequestUri(), 'index.php');

        $cachableMimeTypes = config('site_config.static_cache.cachable_mimetypes', []);

        $isCachableMimeType = false;
        foreach ($contentTypeData as $contentType) {
            $isCachableMimeType = in_array($contentType, $cachableMimeTypes, true) !== false;

            if ($isCachableMimeType === true) {
                break;
            }
        }

        $nonCacheableCacheControlHeaders = config('site_config.static_cache.non_cacheable_cache_control_values', []);

        $hasDisablingCacheHeaders = false;
        foreach ($nonCacheableCacheControlHeaders as $nonCacheableCacheControlHeader) {
            if ($response->headers->hasCacheControlDirective($nonCacheableCacheControlHeader)) {
                $hasDisablingCacheHeaders = true;
                break;
            }
        }

        $return = $this->enabled
            && $response->isOk()
            && !$hasDisablingCacheHeaders
            && !$hasIndexPhpInRequestUri
            && $isGETRequest
            //&& $hasNoParams
            && $isCachableMimeType;
        //\Log::debug('shouldStoreResponse: ' . $return);
        return $return;
    }

    public function buildFilename(Request $request)
    {
        $request_path = trim($request->getPathInfo(), '/');
        $request_path = empty($request_path) ? '' : $request_path;
        $query_string = $request->only(config('site_config.static_cache.query', []));
        $request_path .= ($query_string ? '_' . http_build_query($query_string) : '');

        $request_path = Str::slug($request_path);

        return $request_path;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Response|null $response
     *
     * @return string
     */
    public function getFilename(Request $request, Response $response = null): string
    {
        $request_path = $this->buildFilename($request);

        return public_path(config('site_config.static_cache.cache_path_prefix') . '/' . $request_path) . '.html';
    }

    /**
     * @param string $filename
     */
    private function ensureStorageDirectory(string $filename): void
    {
        $path = $this->files->dirname($filename);

        $this->files->makeDirectory($path, 0777, true, true);

        if (!$this->files->isDirectory($path)) {
            throw new CacheException(sprintf('Directory "%s" could not be created', $path));
        }
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return array
     */
    private function getContentTypeFromResponse(Response $response): array
    {
        return explode(';', $response->headers->get('content-type'));
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function store(Request $request, Response $response): void
    {
        $filename = $this->getFilename($request, $response);

        $this->ensureStorageDirectory($filename);

        $file = $response->getContent();
        $file .= sprintf("\n<!-- [cache page: %s] -->", $request->getRequestUri());
        //$file = str_replace('<html ', '<html t="' . now()->format('Y-m-d H:i:s') . '"', $file);

        if ($this->files->put($filename, $file) === false) {
            throw new CacheException(sprintf('File "%s" could not be created', $filename));
        }
    }

    public function getCache(Request $request)
    {
        $filename = $this->getFilename($request);
        if ($this->files->exists($filename)) {
            $file = $this->files->get($filename);
            return new response($file);
        }

        return false;
    }

    public function forget($uris)
    {
        $uris = (array)$uris;
        collect($uris)->each(function ($uri) {
            $uri           = trim($uri, '/') ?: '_';
            $cache_path    = public_path(config('site_config.static_cache.cache_path_prefix'));
            $matchingFiles = $this->files->glob($cache_path . '/' . $uri . '*');
            $this->files->delete($matchingFiles);
        });
    }

    public function inExceptArray($request): bool
    {
        foreach (config('site_config.static_cache.except') as $except) {
            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }
        return false;
    }

    function accessCache($request): bool
    {
        if (!config('site_config.static_cache.enabled')
            || $request->has('no_cache')
//            || $request->has('page')
//            || $request->has('filters')
            || $this->inExceptArray($request)) {
            return false;
        }
        return true;
    }
}
