@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="news-detail-page" class="thank-you-page">
        @if($zBanner && $zBanner->hasTranslation())
            <div class="new-slide main-content">
                <div class="owl-carousel owl-theme slider-1">
                    @foreach($zBanner->images as $image)
                        <div class="item item-new">
                            <a href="{{ @$image["link"] }}" title="{{ @$image["title"] }}">
                                <img src="{{ @$image["url"] }}"
                                     alt="{{ @$image["alt"] }}"
                                     title="{{ @$image["title"] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="new-description">
            <div class="container-small">
                <div class="new-description-detail">
                    <p>
                        <strong>{{ __("site_global.message_thank_{$slug}_submitted") }}</strong>
                    </p>
                    <p>{{ __("site_global.message_thank_2") }}</p>
                    <p>{{ __("site_global.message_thank_3") }}</p>
                    <ul>
                        <li>
                            <strong>{{ __("site_global.message_thank_4") }}</strong>{{ __("site_global.message_thank_5") }}
                        </li>
                        <li>
                            <strong>{{ __("site_global.message_thank_6") }}</strong>{{ __("site_global.message_thank_7") }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
