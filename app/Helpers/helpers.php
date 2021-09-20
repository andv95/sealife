<?php

if (!function_exists("currentUser")) {
    /**
     * @return \App\Models\User
     */
    function currentUser()
    {
        return \Auth::user();
    }
}

if (!function_exists("setting")) {
    function setting(string $key, $default = "", string $languageKey = null)
    {
        return \App\Models\Setting::getValueByKey($key, $default, $languageKey);
    }
}

if (!function_exists("menu")) {
    function menu($nameOrMenu, array $params = [], $view = null)
    {
        return \App\Models\Menu::getMenuLayout($nameOrMenu, $params, $view);
    }
}

if (!function_exists('site_asset')) {
    function site_asset($path = '')
    {
        return asset('site_assets/' . $path);
    }
}

if (!function_exists('defaultLocale')) {
    function defaultLocale()
    {
        return \App\Models\Language::getDefaultLanguageKey();
    }
}

if (!function_exists('curLocale')) {
    function curLocale()
    {
        return \App\Models\Language::getCurrentLanguageKey();
    }
}

if (!function_exists('transRoute')) {
    function transRoute(string $name, string $transFileName = null)
    {
        $transFileName = ($transFileName ?: "site_routes");

        return Mcamara\LaravelLocalization\Facades\LaravelLocalization::transRoute("{$transFileName}.{$name}");
    }
}

if (!function_exists("localeRoute")) {
    function localeRoute($name, array $parameters = [], $absolute = true)
    {
        $name = "site.locale.{$name}";

        return route($name, $parameters, $absolute);
    }
}

if (!function_exists("siteRoute")) {
    function siteRoute($name, array $parameters = [], $absolute = true)
    {
        $name = "site.{$name}";

        return route($name, $parameters, $absolute);
    }
}

if (!function_exists("imageCacheUrl")) {
    function imageCacheUrl(string $template, string $url = null)
    {
        return \App\Helpers\Helper::getImageCacheUrl($template, $url);
    }
}

if (!function_exists('site_picture')) {
    function site_picture(string $template, string $url, string $alt = '', array $attributes = [])
    {
        $attributes = array_merge([
            'title'       => '',
            'image_class' => '',
            'responsive'  => true,
            'webp'        => true,
            'width'       => '',
            'height'      => '',
        ], $attributes);
        $sizes      = config('site_image.sizes', []);
        if (!$url || !isset($sizes[$template])) {
            return '';
        }
        $mime_type       = \Illuminate\Support\Str::endsWith($url, '.png') ? 'image/png' : 'image/jpeg';
        $sources         = [];
        $size_responsive = $attributes['responsive'] ? config('site_image.responsive', []) : ['default'];
        foreach ($size_responsive as $key) {
            if ($key == 'default' && $attributes['webp']) {
                $sources[] = sprintf('<source srcset="%s.webp" type="image/webp">', imageCacheUrl($template, $url));
                continue;
            }
            $sources[] = sprintf('<source srcset="%s" type="%s" media="(max-width:%dpx)">',
                imageCacheUrl($template . '-' . $key, $url), $mime_type, $key);
            if ($attributes['webp']) {
                $sources[] = sprintf('<source srcset="%s.webp" type="image/webp" media="(max-width:%dpx)">',
                    imageCacheUrl($template . '-' . $key, $url), $key);
            }
        }
        $sources = array_reverse($sources);

        return sprintf('<picture>%s<img loading="lazy" src="%s" alt="%s" class="%s" title="%s" %s %s/></picture>',
            implode("\n", $sources),
            imageCacheUrl($template, $url),
            $alt,
            $attributes['image_class'],
            $attributes['title'],
            ($attributes['width'] ? sprintf('width="%s"', $attributes['width']) : ''),
            ($attributes['height'] ? sprintf('height="%s"', $attributes['height']) : '')
        );
    }
}

if (!function_exists('site_inline_css')) {
    function site_inline_css($path)
    {
        $css_content = \Illuminate\Support\Facades\File::get($path);
        $replaces    = [
            'url(../webfonts/'                        => 'url(/site_assets/lib/fontawesome/webfonts/',
            'url(../'                                 => 'url(/site_assets/',
            ".far{font-family:'Font Awesome 5 Free';" => ".far{font-family:'Font Awesome 5 Free', sans-serif;",
            ".fas{font-family:'Font Awesome 5 Free';" => ".fas{font-family:'Font Awesome 5 Free', sans-serif;",
        ];
        foreach ($replaces as $s => $r) {
            $css_content = str_replace($s, $r, $css_content);
        }
        return $css_content;
    }
}

if (!function_exists('site_footer_distributor')) {
    function site_footer_distributor()
    {
        return cache()->rememberForever('site_footer_distributor', function () {
            return \App\Models\ZDistributor::getEloquentList()
                ->withTranslation()
                ->orderBy("order_no", "asc")
                ->active()
                ->get();
        });
    }
}
