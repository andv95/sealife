<div class="cruise-package-experience ">

    <div class="row cruise-package-experience-row">
        <div class="col-md-3 cruise-package-experience-head">
            <h2 class="head-high-light love-pen">{!! @$head !!}</h2>
            <p>
                {!! @$content !!}
            </p>
        </div>
        <img src="{{ site_asset(!empty($background) ? $background : 'image/background_experience.png')  }}"
             class="background-experience" alt="experience background" title="experience background">
        <div class="col-md-9 cruise-package-experience-content owl-custom-button owl-mobile-number">
            <div class="owl-carousel owl-theme main-experience slider-3_5">
                @foreach($zPosts as $zPost)
                    @if($zPost->hasTranslation())
                        <div class="item item-experience owl-number-custom" data-index-number="{{ $loop->index + 1 }}">
                            <img src="{{ $zPost->getImageUrl() }}" alt="{{ $zPost->image['alt'] }}"
                                 title="{{ $zPost->image['title'] }}">
                            <div class="item-experience-detail">
                                <h3>{{ $zPost->name }}</h3>
                                <div class="item-experience-content">
                                    {{ $zPost->excerpt }}
                                </div>
                                {{--<a href="" class="read-more-public" title="read more">READ MORE</a>--}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="custom-back disabled">‹</button>
            <button class="custom-next">›</button>
            @if(!!$countItem = $zPosts->count())
                <div class="owl-number show-on-mobile">
                    <span class="owl-number-prev">← </span>
                    <span class="owl-number-item-active">01</span>/<span
                        class="owl-number-total">{{ \App\Helpers\Helper::addZeroToNumber($countItem) }}</span>
                    <span class="owl-number-next"> →</span>
                </div>
            @endif
        </div>
    </div>

</div>
