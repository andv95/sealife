<section class="high-light {{ !empty($class) ? $class : '' }}">
    <div class="container">
        <h2 class="head-high-light">{{ !empty($title) ? $title : "" }}</h2>
        <p class="sub-head-high-light">{{ !empty($subtitle) ? $subtitle : "" }}</p>
        <div class="content-text-high-light">
            {!! !empty($excerpt) ? $excerpt : "" !!}
        </div>
    </div>
</section>

@if($data->hasTranslation())
    <section class="list-cruise-home">
        <div class="container">
            <div class="show-on-desktop">
                <div class="row">
                    @foreach($data->zCruisesActiveAtHome as $zCruise)
                        @if($zCruise->hasTranslation())
                            <div class="col-md-6">
                                @include('site.includes.cruise-item', ['data' => $zCruise])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="show-on-mobile">
                <div class="owl-mobile-number">
                    <div class="owl-carousel slider-1-mobile owl-theme list-cruise-home-mobile">
                        @foreach($data->zCruisesActiveAtHome as $zCruise)
                            @if($zCruise->hasTranslation())

                                @include('site.includes.cruise-item', ['data' => $zCruise])

                            @endif
                        @endforeach
                    </div>

                    @if(!!$countCruise = $data->zCruisesActiveAtHome->count())
                        <div class="owl-number show-on-mobile">
                            <span class="owl-number-prev">← </span>
                            <span class="owl-number-item-active">01</span>/<span
                                class="owl-number-total">{{ \App\Helpers\Helper::addZeroToNumber($countCruise) }}</span>
                            <span class="owl-number-next"> →</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
