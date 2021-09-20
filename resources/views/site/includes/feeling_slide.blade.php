<section class="high-light high-light-feeling main-content instar-slider">
    <h2 class="head-high-light">{!! setting('site_home.gallery_head') !!}</h2>
    <div class="gallery-feeling-slide gallery-feeling ">
        <div class="owl-carousel owl-theme slider-4_5 slide-side">
            @foreach($images as $image)
                <div class="gallery-feeling-item">
                    <a href="{{ $image->getImageUrl() }}" title="{{ $image->caption }}">
                        {!! site_picture('review-trip', $image->getImageUrl(), htmlentities($image->alt), ['responsive'=>false]) !!}
                    </a>
                    <img alt="instagram" src="{{ asset('site_assets/image/icons/instagram.svg') }}"
                         class="feeling-instar" loading="lazy"
                         width="25"
                         height="25"
                    />
                </div>
            @endforeach
        </div>
    </div>
    <div class="instagram-feeling">
        <a href="{{ setting('site.social_ins') }}" title="instagram" target="_blank">
            <img alt="instagram" src="{{ asset('site_assets/image/icons/instagram.svg') }}"
                 style="margin-top: -3px;"
                 loading="lazy"
                 width="20"
                 height="20"
            />
            {{ setting('site.instagram_text') }}</a>
    </div>
</section>
