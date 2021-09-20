<section class="high-light high-light-review main-content">
    <div class="container">
        <h2 class="head-high-light">{{ setting('site_home.review_head') }}</h2>
        <p class="sub-head-high-light">{{ setting('site_home.review_sub_head') }}</p>
        <div class="main-review-slide">
            <div class="owl-carousel owl-theme review-slide slider-1">
                @foreach($zReviews as $zReview)
                    @if($zReview->hasTranslation())
                        <div class="item item-review">
                            <a href="#" title="{{ $zReview->name }}">
                                {!! site_picture('review-trip', @setting('site.tripadvisor')['url'], 'Tripadvisor',
['responsive'=>false,'title'=>'Tripadvisor', 'image_class'=>'image-review', 'width'=>170, 'height'=>171]) !!}
                            </a>
                            <h3><a href="#" title="{{ $zReview->name }}">{{ $zReview->name }}</a></h3>
                            <div class="list-star">
                                @if(!empty($zReview->rating))
                                    @for($i = 1; $i<=5; $i++)
                                        {{--                                        <img src="{{ site_asset('image/icons/star.png') }}" alt="star" title="star">--}}
                                        @if($i <= $zReview->rating )
                                            <i class="fas fa-circle trip-icon"></i>
                                        @elseif( $i > $zReview->rating && $i - $zReview->rating == 0.5 )
                                            <img loading="lazy" src='{{ site_asset('/image/icons/circle-half.png') }}'
                                                 class="image-trip-rate" alt="circle half" title="icon circle half">
                                            @php $zReview->rating = round($zReview->rating) ;@endphp
                                        @else
                                            <i class="circle-1-2 trip-icon"></i>
                                        @endif
                                    @endfor
                                @endif
                            </div>

                            <div class="content-star">
                                {!! $zReview->content !!}
                            </div>
                            <div class="footer-review">
                                <p><strong>{{ $zReview->author }}</strong> - {{ $zReview->getDisplayReviewDate() }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
