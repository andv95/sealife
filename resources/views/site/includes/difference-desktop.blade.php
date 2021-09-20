<section class="high-light high-light-difference">
    <div class="container">
        <img loading="lazy" src="{{ site_asset('image/home-gallery-background-left.png') }}"
             alt="Gallery background" title="Gallery background"
             class="home-gallery-background-left">
        <img loading="lazy" src="{{ site_asset('image/home-gallery-background-right.png') }}"
             alt="Gallery background" title="Gallery background"
             class="home-gallery-background-right">
        <div class="container-small">
            <h2 class="head-high-light">{{ setting('site_home.the_sea_group') }}</h2>
            <p class="sub-head-high-light">{{ setting('site_home.differences') }}</p>
            <div class="content-text-high-light">
                <p>{!! setting('site_home.sea_group_content') !!}</p>
            </div>
            <div class="gallery-home-main">
                <div class="row">
                    @php
                        $photos = setting('site_home.differences_photos');
                        $photos = collect($photos);

                        $photo1 = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 1;
                        })->first();
                        $photo2 = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 2;
                        })->first();
                        $photo3 = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 3;
                        })->first();
                        $photo4 = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 4;
                        })->first();
                    @endphp
                    <div class="col-md-6 gallery-home-main-left">
                        @if($photo1)
                            <div class="gallery-home-main-1 gallery-home-main-detail">
                                <a href="{{ @$photo1["url"] }}">
                                    {!! site_picture('difference-one', @$photo1['url'], @$photo1['alt'],
['responsive'=>false,'title'=>@$photo1["title"], 'width'=>465, 'height'=>318]) !!}
                                    <div class="gallery-home-text">
                                        <p>{{ @$photo1['title'] }}</p>
                                    </div>
                                </a>

                            </div>
                        @endif
                        @if($photo2)
                            <div class="gallery-home-main-2 gallery-home-main-detail">
                                <a href="{{ @$photo2["url"] }}">
                                    {!! site_picture('difference-two', @$photo2['url'], @$photo2['alt'],
['responsive'=>false,'title'=>@$photo2["title"], 'width'=>360, 'height'=>260]) !!}
                                    <div class="gallery-home-text">
                                        <p>{{ @$photo2['title'] }}</p>
                                    </div>
                                </a>

                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 gallery-home-main-right">
                        @if($photo3)
                            <div class="gallery-home-main-3 gallery-home-main-detail">
                                <a href="{{ @$photo3["url"] }}">
                                    {!! site_picture('difference-three', @$photo3['url'], @$photo3['alt'],
['responsive'=>false,'title'=>@$photo3["title"], 'width'=>330, 'height'=>450]) !!}
                                    <div class="gallery-home-text">
                                        <p>{{ @$photo3['title'] }}</p>
                                    </div>
                                </a>

                            </div>
                        @endif
                        @if($photo4)
                            <div class="gallery-home-main-4 gallery-home-main-detail">
                                <a href="{{ @$photo4["url"] }}">
                                    {!! site_picture('difference-four', @$photo4['url'], @$photo4['alt'],
['responsive'=>false,'title'=>@$photo4["title"], 'width'=>465, 'height'=>247]) !!}
                                    <div class="gallery-home-text">
                                        <p>{{ @$photo4['title'] }}</p>
                                    </div>
                                </a>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
