<!DOCTYPE html>
<html lang="{{ \App\Models\Language::getCurrentLanguageKey() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="{{ @setting('site.favi_icon')['url'] }}" type="image/x-icon"/>
    <style>
        @if(\App\Models\Language::getCurrentLanguageKey() == 'vi')
        @font-face {
            font-family: 'spartan';
            src: url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.eot')}});
            src: url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.eot')}} ),
            url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.woff2')}}),
            url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.woff')}}),
            url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.ttf')}}),
            url({{ site_asset('font-base/OpenSans-Regular/OpenSans-Regular.svg#spartan')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'OpenSans-Bold';
            src: url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.eot')}});
            src: url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.eot')}}),
            url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.woff2')}}),
            url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.woff')}} ),
            url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.ttf')}}),
            url({{ site_asset('font-base/OpenSans-Bold/OpenSans-Bold.svg#bold-spartan')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'signatie';
            src: url({{ site_asset('font-base/DancingScript/DancingScript-Regular.eot')}});
            src: url({{ site_asset('font-base/DancingScript/DancingScript-Regular.eot')}}),
            url({{ site_asset('font-base/DancingScript/DancingScript-Regular.woff2')}} ),
            url({{ site_asset('font-base/DancingScript/DancingScript-Regular.woff')}} ),
            url({{ site_asset('font-base/DancingScript/DancingScript-Regular.ttf')}}),
            url({{ site_asset('font-base/DancingScript/DancingScript-Regular.svg#signatie')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'prata';
            src: url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.eot')}});
            src: url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.eot')}}),
            url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.woff2')}}),
            url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.woff')}}),
            url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.ttf')}}),
            url({{ site_asset('font-base/BeVietnam/BeVietnam-Regular.svg#parta')}});
            font-display: swap;
        }

        @else
            @font-face {
            font-family: 'spartan';
            src: url({{ site_asset('font-base/spartan/Spartan-Regular.eot')}});
            src: url({{ site_asset('font-base/spartan/Spartan-Regular.eot')}} ),
            url({{ site_asset('font-base/spartan/Spartan-Regular.woff2')}}),
            url({{ site_asset('font-base/spartan/Spartan-Regular.woff')}}),
            url({{ site_asset('font-base/spartan/Spartan-Regular.ttf')}}),
            url({{ site_asset('font-base/spartan/Spartan-Regular.svg#spartan')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'bold-spartan';
            src: url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.eot')}});
            src: url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.eot')}}),
            url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.woff2')}}),
            url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.woff')}} ),
            url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.ttf')}}),
            url({{ site_asset('font-base/spartan-bold/Spartan-SemiBold.svg#bold-spartan')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'signatie';
            src: url({{ site_asset('font-base/signatie/Signatie.eot')}});
            src: url({{ site_asset('font-base/signatie/Signatie.eot')}}),
            url({{ site_asset('font-base/signatie/Signatie.woff2')}} ),
            url({{ site_asset('font-base/signatie/Signatie.woff')}} ),
            url({{ site_asset('font-base/signatie/Signatie.ttf')}}),
            url({{ site_asset('font-base/signatie/Signatie.svg#signatie')}});
            font-display: swap;
        }

        @font-face {
            font-family: 'prata';
            src: url({{ site_asset('font-base/Prata/Prata-Regular.eot')}});
            src: url({{ site_asset('font-base/Prata/Prata-Regular.eot')}}),
            url({{ site_asset('font-base/Prata/Prata-Regular.woff2')}}),
            url({{ site_asset('font-base/Prata/Prata-Regular.woff')}}),
            url({{ site_asset('font-base/Prata/Prata-Regular.ttf')}}),
            url({{ site_asset('font-base/Prata/Prata-Regular.svg#parta')}});
            font-display: swap;
        }
        @endif
    </style>

    {!! SEO::generate() !!}

    @if(View::getSection('page_css'))
        @yield('page_css')
    @else
        <style>{!! site_inline_css(public_path('app/css/site.css')) !!}</style>
    @endif

    {{--    <link rel="stylesheet" href="{{ site_asset('lib/bootstrap/css/bootstrap.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/flatpickr/flatpicker.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/fontawesome/css/all.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/OwlCarousel/dist/assets/owl.carousel.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ site_asset('lib/slick/slick/slick.css') }}"/>--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ site_asset('lib/slick/slick/slick-theme.css') }}"/>--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/Magnific-Popup/dist/magnific-popup.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/select2/select2.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('css/site_style.css?v='.$ver_rand ) }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('css/loading-style.css?v='.$ver_rand ) }}">--}}
    {{--    <link rel="stylesheet" href="{{ site_asset('css/site_responsive.css?v='.$ver_rand) }}">--}}

    @yield('styles')

    @if(\App\Models\Language::getCurrentLanguageKey() == 'vi')
        <script defer>
            document.documentElement.style.setProperty('--main-text-fontsize', '16px');
        </script>
@endif

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0Y4EWJV2DC"></script>
    <script async>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-0Y4EWJV2DC');
    </script>

    <script defer>
        window.onload = function () {
            document.createElement('canvas').toDataURL('image/webp').indexOf('data:image/webp') === 0 && document.body.classList.add('webp');
        }
    </script>
</head>
<body>
@yield('first-body')
<div
    class="body-sealife {{ !empty($isHome) ? 'home-page-body' : '' }} {{ !empty($bannerMenu) ? 'banner-menu' : '' }} @yield('body_class')">
    @include('site.components.header')
    @yield('content')
    @include('site.components.footer')
</div>

@include('site.includes.loading')

{{--<script src="{{ site_asset('lib/jquery-3-4-1.min.js') }}"></script>--}}

{{--<script src="{{ site_asset('lib/flatpickr/flatpicker.min.js') }}"></script>--}}
{{--<script src="{{ site_asset('lib/flatpickr/vn.js') }}"></script>--}}

{{--<script src="{{ site_asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>--}}

{{--<script src="{{ site_asset('lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ site_asset('lib/slick/slick/slick.min.js') }}"></script>--}}
{{--<script src="{{ site_asset('lib/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>--}}
{{--<script src="{{ site_asset('lib/select2/select2.min.js') }}"></script>--}}

{{--<script src="{{ site_asset('js/system.js?v='.$ver_rand) }}"></script>--}}
{{--<script src="{{ site_asset('js/script.js?v='.$ver_rand) }}"></script>--}}
{{--<script src="{{ site_asset('js/script_2.js?v='.$ver_rand) }}"></script>--}}
@if(View::getSection('page_js'))
    @yield('page_js')
@else
    <script src="{{ mix('app/js/site.js') }}"></script>
    @yield('scripts')
@endif
</body>
</html>
