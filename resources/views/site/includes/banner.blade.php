@if($zBanner && $zBanner->hasTranslation())
    @if(!empty($zBanner->video_url))
        <div class="banner-video show-on-desktop">
            @include('site.includes.iframe-vimeo')
        </div>
    @else
        <div class="owl-carousel slider-1 owl-theme main-banner show-on-desktop">
            @foreach($zBanner->images as $item)
                <div class="item">
                    <a href="{{ @$item['link'] }}" title="{{ @$item['title'] }}">
                        {!! site_picture('banner-full', @$item['url'], @$item['alt'], ['width'=>1600, 'height'=>800]) !!}
                        @php
                            $titles = !empty($item['title']) ? explode(',', $item['title']) : '';
                        @endphp
                        @if(!empty($titles))
                            <div class="banner_text">
                                @foreach($titles as $title)
                                    <p>{{ $title }}</p>
                                @endforeach
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
        </div>
    @else
        <div class="owl-carousel slider-1 owl-theme main-banner show-on-mobile">
            @foreach($zBanner->images_mobile as $item)
                <div class="item">
                    <a href="{{ @$item['link']  }}" title="{{ @$item['title'] }}">
                        {!! site_picture('banner-full', @$item['url'], @$item['alt'], ['width'=>420, 'height'=>210]) !!}
                        @php
                            $titles = !empty($item['title']) ? explode(',', $item['title']) : '';
                        @endphp
                        @if(!empty($titles))
                            <div class="banner_text">
                                @foreach($titles as $title)
                                    <p>{{ $title }}</p>
                                @endforeach
                            </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endif
