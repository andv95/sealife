@php
    $zPackages = $data->zPackagesActive;
@endphp

<div class="item-cruise {{ !empty($class) ? $class : '' }} owl-number-custom"
     data-index-number="{{ $loop->index + 1 }}">
    <h2 class="cruise-head-item">
        <a href="{{ $data->getDetailUrl() }}" title="{{ $data->name }}">
            {{ $data->name }}
        </a>
    </h2>
    {{--    <ul class="cruise-destination">--}}
    {{--        @if(!empty($destinations))--}}
    {{--            @foreach($destinations as $destination)--}}
    {{--                <li>{{ $destination }}</li>--}}
    {{--            @endforeach--}}
    {{--        @endif--}}
    {{--    </ul>--}}
    <a href="{{ $data->getDetailUrl() }}" title="{{ $data->name }}">
        {!! site_picture('cruise-item', @$data->image['url'], @$data->image['alt'], ['image_class'=>'cruise-image','width'=>560, 'height'=>301]) !!}
    </a>

    <div class="cruise-content {{ $data->excerpt_show_mobile ? 'show-on-mobile' : '' }}">
        {{ $data->excerpt }}
    </div>
    <div class="cruise-package">
        @foreach($zPackages as $zPackage)
            @if($zPackage->hasTranslation())
                <div class="package-item show-on-desktop">
                    <div class="row">
                        <div class="col-md-2 col-xs-2 package-item-list-1">
                            @if(($zDuration = $zPackage->zDurationActive) && $zDuration->hasTranslation())
                                <h3>{{ $zDuration->short_name }}</h3>
                            @endif
                        </div>
                        <div class="col-md-7 col-xs-7 package-item-list">
                            <h3>
                                <a href="{{ $zPackage->getDetailUrl() }}" title="{{ $zPackage->name }}">
                                    {{ $zPackage->name }}
                                </a>
                            </h3>

                            @foreach($zPackage->zOffersActive as $item)
                                @if($item->hasTranslation())
                                    @include("site.includes.package-offer-item", ["item" => $item, "loop" => $loop])
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-3 col-xs-3  package-item-list-2">
                            <h3 class="package-min-price"
                                data-id="{{ $zPackage->id }}"
                                data-url="{{ route('site.ajax.package.price.min', [$zPackage->id]) }}"
                            >{{-- $zPackage->getMinPriceText() --}}
                                @include('site.includes.loading-svg')
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="package-item show-on-mobile">
                    <div class="row">
                        <div class="col-md-6 package-item-list">
                            <h3><a href="{{ $zPackage->getDetailUrl() }}"
                                   title="{{ $zPackage->name }}">{{ $zPackage->name }}</a></h3>

                            @foreach($zPackage->zOffersActive as $item)
                                @if($item->hasTranslation())
                                    @include("site.includes.package-offer-item", ["item" => $item, "loop" => $loop])
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-3 col-6 package-item-list-1">
                            @if(($zDuration = $zPackage->zDuration) && $zDuration->hasTranslation())
                                <h3>{{ $zDuration->short_name }}</h3>
                            @endif
                        </div>
                        <div class="col-md-3 col-6  package-item-list-2">
                            <h3 class="package-min-price"
                                data-id="{{ $zPackage->id }}"
                                data-url="{{ route('site.ajax.package.price.min', [$zPackage->id]) }}"
                            >{{-- $zPackage->getMinPriceText() --}}
                                @include('site.includes.loading-svg')
                            </h3>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if(!empty($viewDetail))
            <div class="package-view-detail">
                <a href="#" class="button-public">VIEW PROGRAM DETAIL</a>
            </div>
        @endif
    </div>
</div>
