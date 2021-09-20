@extends('site.layouts.master_full_content')

@section('page_css')
    {{--    <style>{!! site_inline_css(public_path('app/css/home.css')) !!}</style>--}}
    <link rel="stylesheet" href="{{ site_asset('css/bootstrap.css' ) }}">
    {{--    <link rel="stylesheet" href="{{ site_asset('lib/bootstrap/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ site_asset('lib/flatpickr/flatpicker.min.css') }}">
    <link rel="stylesheet" href="{{ site_asset('lib/OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ site_asset('lib/OwlCarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ site_asset('lib/Magnific-Popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ site_asset('css/site_style.css' ) }}">
    <link rel="stylesheet" href="{{ site_asset('css/loading-style.css' ) }}">
    <link rel="stylesheet" href="{{ site_asset('css/site_responsive.css' ) }}">
    <link rel="stylesheet" href="{{ site_asset('css/custom.css' ) }}">
@endsection

@section('page_js')
    <script defer src="{{ mix('app/js/home.js') }}"></script>
{{--    <link media="print" onload="this.onload=null;this.removeAttribute('media');" rel="stylesheet"--}}
{{--          href="{{ site_asset('css/fas.css' ) }}">--}}
@endsection

@section('content-full')
    <div class="home-page my-home-page" id="home-page">
        <!--    Content of site-->
        <div class="main-content background-van-van" id="main-content">
            @include('site.includes.banner')
            {{--            search cruise main--}}
            @include('site.includes.search')

            @foreach($zProperties as $key => $zProperty)
                @php
                    $keyNo = ($key + 1);
                @endphp

                {!!  $key == 0 ? '<div class=" cruise-grey">' : ''!!}
                @include('site.includes.properties-list', [
                    'data' => $zProperty,
                    'title' => setting("site_home.property_title_{$keyNo}"),
                    'subtitle' => setting("site_home.property_subtitle_{$keyNo}"),
                    'excerpt' => setting("site_home.property_excerpt_{$keyNo}"),
                ])
                {!!  $key == 0 ? '</div>' : ''!!}
            @endforeach
        </div>

        <div class="cross-high-light">
            <p class="border-bottom-highlight">
                <img src="{{ site_asset('image/icons/icon-cross.png') }}" alt="cross"
                     title="cross" loading="lazy" width="57" height="15">
            </p>
        </div>

        <div class="show-on-desktop">
            @include('site.includes.difference-desktop')
        </div>

        <div class="show-on-mobile">
            @include('site.includes.difference-mobile')
        </div>

        @include('site.includes.review_slide')

        @include('site.includes.feeling_slide', ['images' => $insPhotos])

        @include('site.includes.newsletter')
    </div>
@endsection
