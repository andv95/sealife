<div class="special-offer-item">
    <div class="row">
        <div class="col-md-4 offer-item-left">
            <a href="{{ $item->getDetailUrl(["date" => !empty($date) ? $date : null]) }}" title="{{ $item->name }}">
                <img src="{{ $item->getImageUrl() }}" alt="{{ @$item->image['alt'] }}"
                     title="{{ @$item->image['title'] }}">
            </a>
        </div>
        <div class="col-md-8 offer-item-right">
            <span class="special-high-light">
                @if(($duration = $item->zDurationActive) && $duration->hasTranslation())
                    {{ $duration->name }}
                @endif
            </span>

            <h2 class="special-offer-item-title">
                <a href="{{ $item->getDetailUrl(["date" => !empty($date) ? $date : null]) }}" title="{{ $item->name }}">
                    {{ $item->name }}
                </a>
            </h2>

            <p class="special-offer-item-subtitle">
                Excursions:
                @foreach($item->zDestinationsActive as $destination)
                    {{ $destination->name }}
                    @if(!$loop->last) - @endif
                @endforeach
            </p>

            <div class="special-offer-section">
                @foreach($item->zOffersActive  as $zOffer)
                    @if($zOffer->hasTranslation())
                        @include("site.includes.package-offer-item", ["item" => $zOffer, "loop" => $loop])
                    @endif
                @endforeach
            </div>

            <div class="footer-special-offer">
                @if($item->getMinPriceNoPromotionText(!empty($date) ? $date : null))
                    <div class="footer-special-offer-1">
                        <span>{{ __('site_global.label_was') }}</span>
                        <h2>{!! $item->getMinPriceByDateText(!empty($date) ? $date : null) !!}</h2>
                    </div>

                    <div class="footer-special-offer-2">
                        <span>{{ __('site_global.label_starting_from') }}</span>
                        <h2>{!! $item->getMinPriceNoPromotionText(!empty($date) ? $date : null) !!}</h2>
                    </div>
                @else
                    <div class="footer-special-offer-2">
                        <span>{{ __('site_global.label_starting_from') }}</span>
                        <h2>{!! $item->getMinPriceByDateText(!empty($date) ? $date : null) !!}</h2>
                    </div>
                @endif

                <a href="{{ $item->getDetailUrl(["date" => !empty($date) ? $date : null]) }}" title="{{ $item->name }}"
                   class="button-public button-public-special">{{ __('site_global.label_book_now') }}</a>
            </div>
        </div>
    </div>
</div>
