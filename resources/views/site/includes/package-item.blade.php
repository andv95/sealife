<div class="item-cruise owl-number-custom" data-index-number="{{ $loop->index + 1 }}">
    <h2 class="cruise-head-item">
        <a href="{{ $zPackage->getDetailUrl() }}"
           title="{{ $zPackage->name }}">
            {{ $zPackage->name }}
        </a>
    </h2>

    <a href="{{ $zPackage->getDetailUrl() }}"
       title="{{ $zPackage->name }}">
        <img src="{{ @$zPackage->getImageUrl() }}" class="cruise-image" title="{{ @$zPackage->image['title'] }}"
             alt="{{ @$zPackage->image['alt'] }}">
    </a>

    <div class="cruise-content">
        <ul class="cruise-destination">
            @foreach($zPackage->zDestinationsActive as $destination)
                <li>{{ $destination->name }}</li>
            @endforeach
        </ul>
    </div>

    <div class="special-offer-section">
        @foreach($zPackage->zOffersActive  as $item)
            @if($item->hasTranslation())
                @include("site.includes.package-offer-item", ["item" => $item, "loop" => $loop])
            @endif
        @endforeach
    </div>

    <div class="cruise-package-price">
        <div class="row">
            <div class="col-md-6 cruise-package-price-left">
                @if($zPackage->getMinPriceNoPromotionText())
                    <div class="row">
                        <p class="col-md-7 col-6">{{ __('site_global.label_was') }}</p>
                        <p class="col-md-5 col-6">{!! $zPackage->getMinPriceNoPromotionText() !!}</p>
                    </div>
                @endif
                <div class="row">
                    <p class="col-md-7 col-6">{{ __('site_global.label_starting_from') }}</p>
                    <p class="col-md-5 col-6"><strong>{!! $zPackage->getMinPriceText() !!}</strong></p>
                </div>
            </div>
            <div class="col-md-6 cruise-package-price-right">
                <a href="{{ $zPackage->getDetailUrl() }}" class="button-public"
                   title="{{ $zPackage->name }}">{{ __('site_global.label_view_details') }}</a>
            </div>
        </div>
    </div>
</div>
