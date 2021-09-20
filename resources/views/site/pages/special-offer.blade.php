@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="special-offer-page">
        <div class="special-offer-top">
            <div class="container-small">
                <h2 class="head-high-light love-pen">{!! setting('site_other.current_travel') !!}</h2>
                <div class="special_offer_tab_wrapper js_special_offer_wrapper">
                    <div class="show-on-desktop">
                        <div class="row">
                            @php
                                $count = 1;
                            @endphp
                            @foreach($zSpecialOffers as $item)
                                @if($item->hasTranslation())
                                    <div class="col-md-4">
                                        <div
                                            class="special-offer-top-item special-offer-top-item-{{ $count }} js_special_offer_item @if($selectedSpecialOfferId == $item->getKey()) special-active js_filter_item_active @endif"
                                            data-id="{{ $item->getKey() }}" data-position="{{ $count }}">
                                            <a href="javascript:void(0);" title="{{ $item->name }}">
                                                <div class="special-offer-top-detail">
                                                    <h3 class="special-offer-title">{{ $item->name }}</h3>
                                                    <h3 class="special-offer-subtitle">{{ $item->short_desc }}</h3>
                                                    <p>{{ $item->invalid_desc }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @php
                                        $count++;
                                        $count = $count == 4 ? 0 : $count;
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="show-on-mobile">
                        <div class="owl-carousel special-offer-mobile owl-theme">
                            @foreach($zSpecialOffers as $item)
                                @if($item->hasTranslation())
                                    <div class="item">
                                        <div
                                            class="special-offer-top-item special-offer-top-item-{{ $count }} js_special_offer_item @if($selectedSpecialOfferId == $item->getKey()) special-active js_filter_item_active @endif"
                                            data-id="{{ $item->getKey() }}" data-position="{{ $count }}">
                                            <a href="javascript:void(0);" title="{{ $item->name }}">
                                                <div class="special-offer-top-detail">
                                                    <h3 class="special-offer-title">{{ $item->name }}</h3>
                                                    <h3 class="special-offer-subtitle">{{ $item->short_desc }}</h3>
                                                    <p>{{ $item->invalid_desc }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @php
                                        $count++;
                                        $count = $count == 4 ? 0 : $count;
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="special-offer-filter js_special_offer_filter_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <span class="special-offer-label">{{ __('site_global.label_filters') }}:</span>
                    </div>
                    <div class="col-md-11">
                        @foreach($zDestinations as $item)
                            @if($item->hasTranslation())
                                <a href="javascript:void(0);" title="{{ $item->name }}" data-id="{{ $item->getKey() }}"
                                   class="filter-link js_filter_destination js_special_offer_filter_item @if(in_array($item->getKey(), $selectedDestinationIds) || !$selectedDestinationIds) filter-active js_filter_item_active @endif">{{ $item->name }}</a>
                            @endif
                        @endforeach

                        @foreach($zDurations as $item)
                            @if($item->hasTranslation())
                                <a href="javascript:void(0);" title="{{ $item->name }}" data-id="{{ $item->getKey() }}"
                                   class="filter-link js_filter_duration js_special_offer_filter_item @if(in_array($item->getKey(), $selectedDurationIds) || !$selectedDurationIds) filter-active js_filter_item_active @endif">{{ $item->name }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <section class="list-special-offer-item">
            <div class="container js_special_offer_package_render">
                @foreach($zPackages as $item)
                    @include("site.includes.offer-package-item", ["item" => $item, "date" => $date])
                @endforeach
            </div>
        </section>

        @include('site.includes.newsletter')
    </div>

    <input type="hidden" id="js_filter_url" value="{{ localeRoute("special_offers.filters") }}">
    <input type="hidden" id="js_stored_date" value="{{ $date }}">
@endsection

@section("scripts")
    <script src="{{ site_asset('js/special_offer.js?v="'.rand(1,9999).'"') }}"></script>
@stop
