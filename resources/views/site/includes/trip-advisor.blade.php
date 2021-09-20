<div class="tripadvisor-reviews-wrapper js_package_reviews">
    <input type="hidden" class="js_package_review_current_page"
           value="{{ !empty($currentPage) ? $currentPage : null }}">
    <div class="tripadvisor-reviews">
        <div class="tripadvisor-head">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ setting('site_package.tripadvisor_reviews') }}</h2>
                    <div class="trip-head-star">
                        <span>4.8</span>
                        <i class="far fa-dot-circle"></i>
                        <i class="far fa-dot-circle"></i>
                        <i class="far fa-dot-circle"></i>
                        <i class="far fa-dot-circle"></i>
                        <i class="far fa-dot-circle"></i>
                    </div>
                </div>
                <div class="col-md-6 ">
{{--                    <div class="trip-head-human">--}}
{{--                        <img src="{{ site_asset('image/human.jpg') }}" alt="" title="">--}}
{{--                        <img src="{{ site_asset('image/human2.jpg') }}" alt="" title="">--}}
{{--                        <img src="{{ site_asset('image/human3.jpg') }}" alt="" title="">--}}
{{--                        <img src="{{ site_asset('image/human.jpg') }}" alt="" title="">--}}
{{--                        <img src="{{ site_asset('image/human3.jpg') }}" alt="" title="">--}}
{{--                        <p>RECOMMEND BY 500 PEOPLE</p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="tripadvisor-content js_package_reviews_content">
            @include("site.includes.package-review-items", ["zReviews" => $zReviews])
        </div>

        @if($zReviewsNextPage)
            <div class="load-more js_package_reviews_load_more">
                <a href="javascript:void(0);" title="{{ __("site_global.label_load_more") }}"
                   data-url="{{ localeRoute("packages.get_reviews") }}"
                   data-package-id="{{ $packageId }}">{{ __("site_global.label_load_more") }}</a>
            </div>
        @endif
    </div>
</div>
