@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="cruise-page">
        <div class="main-content background-van-van" id="main-content">
            <div class="banner-cruise">
                @include('site.includes.banner-cruise', ['zBanner' => $zBanner])
            </div>
            @include('site.includes.cruise-high-light', ['data' => $zCruise])

        </div>

        <div class="container">
            @include('site.includes.key-facts', ["data" => $zCruise])
        </div>
        <p class="border-bottom-highlight">
            <img src="{{  site_asset('/image/icons/icon-cross.png') }}" alt="cross"
                 title="cross">
        </p>

        <div class="list-package-cruise">
            <div class="container">
                <h2 class="head-high-light love-pen">{!! setting('site_cruise.cruise_room_head') !!}</h2>
                <div class="show-on-desktop">
                    <div class="d-flex justify-content-center row">
                        @foreach($zRooms as $zRoom)
                            @include('site.includes.item-room-cruise')
                        @endforeach
                    </div>
                </div>
                <div class="show-on-mobile">
                    <div class="owl-custom-button owl-mobile-number">
                        <div class="owl-carousel owl-theme room-list">
                            @foreach($zRooms as $zRoom)
                                @include('site.includes.item-room-cruise')
                            @endforeach
                        </div>
                        @if(($zRooms->count())>4)
                            <button class="custom-back disabled">‹</button>
                            <button class="custom-next">›</button>
                        @endif

                        @if(!!$countItem = $zRooms->count())
                            <div class="owl-number show-on-mobile">
                                <span class="owl-number-prev">← </span>
                                <span class="owl-number-item-active">01</span>/<span
                                    class="owl-number-total">{{ \App\Helpers\Helper::addZeroToNumber($countItem) }}</span>
                                <span class="owl-number-next"> →</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @php
            $head = setting('site_cruise.cruiseExperienceHead');
            $content = setting('site_cruise.cruiseExContent');
        @endphp
        @include('site.includes.experience', ["zPosts" => $zPosts, "head" => $head, "content" => $content])

        <div class="cruise-trip">
            <section class="high-light {{ !empty($class) ? $class : '' }}">
                <div class="container">
                    <h2 class="head-high-light love-pen">{!! setting('site_cruise.cruise_package_head') !!}</h2>
                    <div class="content-text-high-light">
                        {!! setting('site_cruise.cruisePackageContent') !!}
                    </div>
                </div>
            </section>


            <section class="list-cruise-home">
                <div class="container">
                    <div class="show-on-desktop">
                        <div class="row">
                            @foreach($zPackages as $zPackage)
                                @if($zPackage->hasTranslation())
                                    <div class="col-md-6">
                                        @include('site.includes.package-item', ['zPackage' => $zPackage])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="show-on-mobile owl-mobile-number">
                        <div class="owl-carousel slider-1-mobile owl-theme list-cruise-home-mobile">
                            @foreach($zPackages as $zPackage)
                                @if($zPackage->hasTranslation())
                                    @include('site.includes.package-item', ['zPackage' => $zPackage])
                                @endif
                            @endforeach
                        </div>
                        @if(!!$countItem = $zPackages->count())
                            <div class="owl-number show-on-mobile">
                                <span class="owl-number-prev">← </span>
                                <span class="owl-number-item-active">01</span>/<span
                                    class="owl-number-total">{{ \App\Helpers\Helper::addZeroToNumber($countItem) }}</span>
                                <span class="owl-number-next"> →</span>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>

        @include('site.includes.feeling_slide', ['images' => $insPhotos])

        @include('site.includes.newsletter')
    </div>
@endsection
