<div class="item-room-package-detail">
    <div class="row">
        <div class="col-lg-7 item-room-package-detail-left item-room-package-detail-public">
            <div class="slick-1 slick-package-room">
                @foreach($zRoom->images as $image)
                    <div class="slick-item">
                        <img src="{{ @$image["url"] }}" title="{{ @$image['title'] }}" alt="{{ @$image['alt'] }}"
                             class="show-on-desktop">
                        <img src="{{ \App\Helpers\Helper::getImageCacheUrl('package-gallery-mobile', @$image['url']) }}"
                             title="{{ @$image['title'] }}" alt="{{ @$image['alt'] }}" class="show-on-mobile">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-5 item-room-package-detail-right item-room-package-detail-public">
            <h2>{{ $zRoom->name }}</h2>

            @include('site.includes.key-facts', ["data" => $zRoom])

            @if($date)
                @if(array_key_exists("promotion", $room))
                    <div class="room-list-price">
                        <div class="row">
                            <div class="col-md-5 room-list-price-left">
                                <h3>{{ $room['promotion']['title'] }}</h3>
                                <p>{{ $room['promotion']['desc'] }}</p>
                            </div>
                            <div class="col-md-7 room-list-price-right">
                                <h3>{{ $room['price_prefix'].\App\Helpers\Helper::getFormatPrice($room['promotion']['price']) . $room['unit'] }}</h3>
                                <a href="javascript:void(0);" title="{{ $room['promotion']['title'] }}"
                                   class="button-public js_package_room_book_promotion"
                                   data-room-id="{{ $room['room_id'] }}">{{ __('site_global.label_book_now') }}</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="room-list-price">
                    <div class="row align-items-center">
                        <div class="col-md-5 room-list-price-left">
                            @if(!$pk_nha_hang)
                                <h3 class="mb-0">{{ __("site_global.label_promotion_flexible") }}</h3>
                            @endif
                        </div>
                        <div class="col-md-7 room-list-price-right">
                            @if(!$pk_nha_hang)
                                <h3>{{ $room['price_prefix'].\App\Helpers\Helper::getFormatPrice($room['price']) . $room['unit'] }}</h3>
                            @endif
                            <a href="javascript:void(0);" title="{{ __("site_global.label_promotion_flexible") }}"
                               data-room-id="{{ $room['room_id'] }}"
                               class=" button-public js_package_room_book_promotion js_package_room_book_flexible">
                                {{ __('site_global.label_book_now') }}
                            </a>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            @else
                @include('site.includes.choose-date-show-price')
            @endif
        </div>
    </div>
</div>
