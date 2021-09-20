<section class="high-light high-light-difference">
    <div class="container">
        <div class="container-small">
            <h2 class="head-high-light">{{ setting('site_home.the_sea_group') }}</h2>
            <p class="sub-head-high-light">{{ setting('site_home.differences') }}</p>
            <div class="content-text-high-light">
                <p>{!! setting('site_home.sea_group_content') !!}</p>
            </div>
            <div class="gallery-home-main-mobile main-content">
                <div class="owl-carousel slider-1-mobile owl-theme difference-mobile">
                    @php
                        $photos = setting('site_home.differences_photos');
                        $photos = collect($photos);

                        $showPhotos[] = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 1;
                        })->first();
                        $showPhotos[] = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 2;
                        })->first();
                        $showPhotos[] = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 3;
                        })->first();
                        $showPhotos[] = $photos->filter(function ($photo) {
                            return @$photo['order_no'] == 4;
                        })->first();
                    @endphp
                    @foreach($showPhotos as $showPhoto)
                        @if($showPhoto)
                            <div class="gallery-home-main-detail-mobile">
                                {!! site_picture('difference-one', @$showPhoto['url'], @$showPhoto['alt'], ['title'=>@$showPhoto["title"],'width'=>420, 'height'=>287]) !!}

                                <div class="gallery-home-text">
                                    <p>{{ @$showPhoto['title'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
