<div class="package-page-banner">
    <div class="row">
        <div class="col-lg-9">
            <div class="show-on-desktop">
                <div class="row slider-gallery gallery-home-main">
                    @foreach($images as $image)
                        {!! ($loop->first) ? '<div class="col-md-9 slider-gallery-main">' : null !!}

                        {!! ($loop->index == 1) ? '<div class="col-md-3 slider-gallery-list">' : null !!}
                        @php
                            if ($loop->first) {
                                $slideImage = \App\Helpers\Helper::getImageCacheUrl('package-detail-main', @$image['url']);
                            } else {
                                $slideImage= \App\Helpers\Helper::getImageCacheUrl('package-detail-main-side', @$image['url']);
                            }
                        @endphp
                        <a href="{{ @$image['url'] }}" title="{{ @$image['title'] }}"
                           @if(!$loop->first && $loop->index < 5) class="slider-gallery-list-number" @endif>
                            @if($loop->index < 5)
                                <img
                                    src="{{ $slideImage }}"
                                    alt="{{ @$image['alt'] }}"
                                    title="{{ @$image['title'] }}">
                            @endif

                            @if($loop->index == 4)
                                <span>{{ ($images->count() - 5). "+" }}</span>
                            @endif
                        </a>

                        {!! ($loop->first || $loop->last) ? '</div>' : null !!}
                    @endforeach
                </div>
            </div>
            <div class="show-on-mobile main-content">
                <div class="owl-carousel slider-1 owl-theme slider-gallery gallery-home-main">
                    @foreach($images as $image)
                        <a href="{{ @$image['url'] }}" title="{{ @$image['title'] }}">
                            <img
                                src="{{ \App\Helpers\Helper::getImageCacheUrl('package-gallery-mobile', @$image['url']) }}"
                                alt="{{ @$image['alt'] }}"
                                title="{{ @$image['title'] }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-3 check-availability-wrapper" id="search-date-package">
            <div class="check-availability">
                <form action="{{ localeRoute('packages.send_inquiry') }}" method="GET"
                      id="js_package_form_send_inquiry">
                    <input type="hidden" name="package_id" value="{{ $zPackage->getKey() }}">
                    <input type="hidden" name="room_id" id="js_package_input_room_id"
                           value="{{ $zPackage->getMinPriceByDate($date)["roomApiId"] }}">
                    <input type="hidden" id="js_package_input_flexible_promotion"
                           name="is_flexible_promotion" value="0">

                    <h2>{!! __('site_global.label_check_rate') !!}</h2>
                    <div class="dropdown dropdown-search search-date">
                        <input type="text"
                               class="dropdown-toggle search-date-input flatpickr-input js_package_select_date"
                               data-package-id="{{ $zPackage->getKey() }}"
                               data-url="{{ localeRoute("packages.get_price_and_rooms_by_date") }}"
                               placeholder="{{ __('site_global.label_check_in') }}" readonly="readonly" name="date"
                               value="{{ $date }}"
                               id="search-date">
                        <i class="fa fa-chevron-down"></i>
                    </div>

                    <div class="js_package_price_render">
                        @include("site.pages.sub.package-detail-price", ["date" => $date, "zPackage" => $zPackage, 'id_pk_nha_hang'=>$id_pk_nha_hang])
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
