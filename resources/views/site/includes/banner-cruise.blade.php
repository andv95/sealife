@if($zBanner && $zBanner->hasTranslation())
    @if(!empty($zBanner->video_url))
        <div class="banner-video show-on-desktop">
            @include('site.includes.iframe-vimeo')
            <div class="footer_banner_text footer_banner_text_video">
                <span>{{ __('site_global.label_play_video') }} <i class="far fa-play-circle"></i></span>
            </div>
        </div>
    @else
        <div class="owl-carousel slider-1 owl-theme main-banner show-on-desktop">
            @foreach($zBanner->images as $item)
                <div class="item">
                    <a href="{{ @$item['link'] }}" title="{{ @$item['title'] }}">
                        <img src="{{ @$item['url'] }}" alt="{{ @$item['alt'] }}" title="{{ @$item['title'] }}">
                        @php
                            $titles = !empty($item['title']) ? explode(',', $item['title']) : '';
                        @endphp
                        @if(!empty($titles))
                            <div class="banner_text">
                                @foreach($titles as $title)
                                    <p>{!! $title !!}</p>
                                @endforeach
                                <div class="footer_banner_text">
                                    <a href="{{ $zBanner->view_more_url }}"
                                       title="{{ $item['title'] }}">{{ __('site_global.label_view_more_photo') }}</a>
                                </div>
                            </div>
                        @endif
                        <div class="clear-both"></div>
                    </a>
                </div>
            @endforeach
        </div>

    @endif
    @if(!empty($zBanner->video_url_mobile))
        <div class="banner-video show-on-mobile">
            @include('site.includes.iframe-vimeo')
            <div class="footer_banner_text footer_banner_text_video">
                <span>{{ __('site_global.label_play_video') }} <i class="far fa-play-circle"></i></span>
            </div>
        </div>
    @else
        <div class="owl-carousel slider-1 owl-theme main-banner show-on-mobile">
            @foreach($zBanner->images_mobile as $item)
                <div class="item">
                    <a href="{{ @$item['link'] }}" title="{{ @$item['title'] }}">
                        <img src="{{ @$item['url'] }}" alt="{{ @$item['alt'] }}" title="{{ @$item['title'] }}">
                        @php
                            $titles = !empty($item['title']) ? explode(',', $item['title']) : '';
                        @endphp
                        @if(!empty($titles))
                            <div class="banner_text">
                                @foreach($titles as $title)
                                    <p>{!!  $title!!}</p>
                                @endforeach
                                <div class="footer_banner_text">
                                    <a href="{{ $zBanner->view_more_url }}"
                                       title="{{ $item['title'] }}">{{ __('site_global.label_view_more_photo') }}</a>
                                </div>
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endif
