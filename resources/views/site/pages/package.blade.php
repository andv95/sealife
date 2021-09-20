@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="package-page" class="hr-page">
        <div class="container">
            <h1 class="page-title" itemprop="headline name">{{ $zPackage->name }}</h1>
            <ul class="breadcrumb">
                <li><a href="/">{{ __('site_global.home') }} <i class="fas fa-chevron-right icon-breadcrumb"></i></a></li>
                <li><a href="{{ $zPackage->getDetailUrl() }}">{{ \Illuminate\Support\Str::title($zPackage->name) }}</a></li>
            </ul>
            <ul class="cruise-destination">
                @foreach($zDestinations as $item)
                    @if($item->hasTranslation())
                        <li>{{ $item->name }}</li>
                    @endif
                @endforeach
            </ul>

            <div class="package-page-offer">
                @foreach($zOffers  as $item)
                    @if($item->hasTranslation())
                        @include("site.includes.package-offer-item", ["item" => $item, "loop" => $loop])
                    @endif
                @endforeach
            </div>

            @include('site.includes.package-gallery')
        </div>
        <div class="package-itinerary-download">
            <div class="itinerary">
                <div class="container">
                    <div class="container-small itinerary-package-head">
                        <h2 class="section-title">{{ __('site_global.label_itinerary') }}</h2>
                        <div class="section-content">
                            <p>
                                {{ $itineraries["title"] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row list-itinerary-package">
                    <div class="list-itinerary col-md-6">
                        <div class="list-iti-slide">
                            @include('site.includes.itinerary-slide', ['itineraries' => $itineraries])
                        </div>
                    </div>
                    <div class="col-md-6 map-package-wrapper">
                        <img
{{--                            src="{{ \App\Helpers\Helper::getImageCacheUrl("package-map", @$zPackage->itinerary_bg_image['url']) }}"--}}
                            src="{{ @$zPackage->itinerary_bg_image['url'] }}"
                            class="map-package"
                            alt="{{ @$zPackage->itinerary_bg_image['alt'] }}"
                            title="{{ @$zPackage->itinerary_bg_image['title'] }}">
                    </div>
                </div>
            </div>

            @if($zPackage->itinerary_file)
                <div class="download-document">
                    <div class="container">
                        <div class="container-small">
                            <div class="row">
                                <div class="col-md-1"><img src="{{ site_asset('image/icons/download.png') }}"
                                                           alt="Download document" title="Download document"></div>
                                <div class="col-md-7">
                                    <h3>{{ setting('site_package.packageDownloadHead') }}</h3>
                                    <p>{{ setting('site_package.PKDownloadContent') }}</p>
                                </div>
                                <div class="col-md-4"><a href="{{ $zPackage->itinerary_file }}" download
                                                         class="button-public"
                                                         title="download document"
                                                         target="_blank">{{ __('site_global.label_download_brochure') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
        @php
            $head = setting('site_package.on_activity_head');
            $content = setting('site_package.on_activity_content');
            $background = 'image/background_on_active.png';
        @endphp

        <div class="cruise-package-experience-package-page">
            @include('site.includes.experience', ["zPosts" => $zPosts, 'head' => $head, 'content' => $content, 'background' => $background])
        </div>

        <div class="room-slider" id="room-slider">
            <div class="container">
                <h2 class="section-title">SUITES</h2>

                <div class="js_package_rooms_render">
                    <div class="show-on-desktop">
                        @include('site.includes.room-slider',
                            ["rooms" => $apiRoomsWithZRooms, "date" => $date, 'pk_nha_hang' => $id_pk_nha_hang == $zPackage->id,])
                    </div>
                    <div class="show-on-mobile">
                        @include('site.includes.room-slider-mobile', ["rooms" => $apiRoomsWithZRooms, "date" => $date, 'pk_nha_hang' => $id_pk_nha_hang == $zPackage->id,])
                    </div>
                </div>
            </div>
        </div>

        <div class="package-terms">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="my-accordion">
                            <div class="accordion md-accordion" id="accordionPolicy" role="tablist"
                                 aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="price_inclusion_heading">
                                        <a data-toggle="collapse" data-parent="#accordionPolicy"
                                           href="#price_inclusion_collapse"
                                           aria-expanded="true"
                                           aria-controls="price_inclusion_collapse">
                                            <h5 class="mb-0">
                                                {{ setting('site_package.pkPriceInclusion') }}
                                                <span class="plus-acc">-</span>
                                            </h5>
                                        </a>
                                    </div>
                                    <div id="price_inclusion_collapse" class="collapse show"
                                         role="tabpanel"
                                         aria-labelledby="price_inclusion_heading"
                                         data-parent="#accordionPolicy">
                                        <div class="card-body">
                                            {!! $zPackage->price_inclusion !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="price_exclusion_heading">
                                        <a data-toggle="collapse" data-parent="#accordionPolicy"
                                           href="#price_exclusion_collapse"
                                           aria-controls="price_exclusion_collapse">
                                            <h5 class="mb-0">
                                                {{ setting('site_package.pkPriceExclusion') }} <span
                                                    class="plus-acc">+</span>
                                            </h5>
                                        </a>
                                    </div>
                                    <div id="price_exclusion_collapse" class="collapse"
                                         role="tabpanel"
                                         aria-labelledby="price_exclusion_heading"
                                         data-parent="#accordionPolicy">
                                        <div class="card-body">
                                            {!! $zPackage->price_exclusion !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="cruise_policy_heading">
                                        <a data-toggle="collapse" data-parent="#accordionPolicy"
                                           href="#cruise_policy_collapse"
                                           aria-controls="cruise_policy_collapse">
                                            <h5 class="mb-0">
                                                {{ setting('site_package.pkCruisePolicy') }} <span
                                                    class="plus-acc">+</span>
                                            </h5>
                                        </a>
                                    </div>
                                    <div id="cruise_policy_collapse" class="collapse"
                                         role="tabpanel"
                                         aria-labelledby="cruise_policy_heading"
                                         data-parent="#accordionPolicy">
                                        <div class="card-body">
                                            {!! $zPackage->cruise_policy !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" role="tab" id="booking_policy_heading">
                                        <a data-toggle="collapse" data-parent="#accordionPolicy"
                                           href="#booking_policy_collapse"
                                           aria-controls="booking_policy_collapse">
                                            <h5 class="mb-0">
                                                {{ setting('site_package.pkBookingPolicy') }} <span
                                                    class="plus-acc">+</span>
                                            </h5>
                                        </a>
                                    </div>
                                    <div id="booking_policy_collapse" class="collapse"
                                         role="tabpanel"
                                         aria-labelledby="booking_policy_heading"
                                         data-parent="#accordionPolicy">
                                        <div class="card-body">
                                            {!! $zPackage->booking_policy !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @include('site.includes.trip-advisor', [
                            "zReviews" => $zReviews,
                            "zReviewsNextPage" => $zReviewsNextPage,
                            "packageId" => $zPackage->getKey()
                        ])
                    </div>
                </div>
            </div>
        </div>

        @include('site.includes.newsletter')
    </div>
@endsection

@section("scripts")
    <script src="{{ site_asset('js/z_package.js?v="'.rand(1,9999).'"') }}"></script>
@stop
