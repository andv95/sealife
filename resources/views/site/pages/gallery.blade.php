@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="gallery-page">
        <h1 class="page-title" itemprop="headline name">{{ __('site_global.label_gallery') }}</h1>
        <div class="container-small">
            <div class="new-destinations">
                <ul>
                    @foreach($zGalleryTypes as $type)
                        @if($type->hasTranslation())
                            <li @if($type->slug === request()->route('slug')) class="active-new" @endif>
                                <a href="{{ localeRoute('galleries', ['slug' => $type->slug]) }}"
                                   title="{{ $type->name }}">{{ $type->name }}</a>
                                @if(!!$type->zGalleryTypesActive->count())
                                    <ul>
                                        @foreach($type->zGalleryTypesActive as $typeChild)
                                            <li @if($typeChild->slug === request()->route('slug')) class="active-new-inside" @endif>
                                                <a href="{{ localeRoute('galleries', ['slug' => $typeChild->slug]) }}"
                                                   title="{{ $typeChild->name }}">{{ $typeChild->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    <li class="clear-both"></li>
                </ul>
            </div>

            @if($zGallery)
                <div class="show-on-desktop">
                    <div class="gallery-in-page gallery-home-main">
                    @php
                        $imagesOrVideos = collect($zGallery->images)->sortBy("order_no");
                        $leaveGalleryCount = $imagesOrVideos->count() - 6;
                    @endphp
                    @foreach($imagesOrVideos as $image)
                        @if($loop->first)
                            <div class="gallery-main-image">
                                <a href="{{ $zGallery->getUrl($image) }}"
                                   title="{{ @$image['title'] }}" {!! $zGallery->isVideo($image) ? 'class="mfp-iframe"' : '' !!}>
                                    <img src="{{ @$zGallery->getUrlImage($image, true) }}"
                                         alt="{{ @$image['alt'] }}"
                                         title="{{ @$image['title'] }}">
                                    {!! $zGallery->isVideo($image) ? '<i class="far fa-play-circle"></i>' : '' !!}
                                </a>
                            </div>
                        @else
                            {!! $loop->index === 1 ? '<div class="gallery-footer">' : '' !!}
                            @if($loop->index <= 5)
                                <a href="{{ $zGallery->getUrl($image) }}" title="{{ @$image['title'] }}"
                                    {!! $zGallery->isVideo($image) ? 'class="mfp-iframe"' : '' !!}>
                                    <img src="{{ @$zGallery->getUrlImage($image) }}" alt="{{ @$image['alt'] }}"
                                         title="{{ @$image['title'] }}">
                                    {!! $zGallery->isVideo($image) ? '<i class="far fa-play-circle"></i>' : '' !!}
                                    {!! ($loop->index === 5 && $leaveGalleryCount) ? '<span>'. $leaveGalleryCount .'+</span>' : '' !!}
                                </a>
                            @else
                                <a href="{{ $zGallery->getUrl($image) }}" title="{{ @$image['title'] }}"
                                   class="galley-not-image {{ $zGallery->isVideo($image) ? 'mfp-iframe' : '' }}">
                                </a>
                            @endif

                            {!! $loop->last ? '<div class="clear-both"></div></div>' : '' !!}
                        @endif
                    @endforeach
                </div>
                </div>
                <div class="show-on-mobile main-content">
                    <div class="owl-carousel slider-1 owl-theme slider-gallery gallery-home-main">
                        @foreach($imagesOrVideos as $image)
                            <div class="gallery-main-image">
                                <a href="{{ $zGallery->getUrl($image) }}"
                                   title="{{ @$image['title'] }}" {!! $zGallery->isVideo($image) ? 'class="mfp-iframe"' : '' !!}>
                                    <img src="{{ @$zGallery->getUrlImage($image, true) }}"
                                         alt="{{ @$image['alt'] }}"
                                         title="{{ @$image['title'] }}">
                                    {!! $zGallery->isVideo($image) ? '<i class="far fa-play-circle"></i>' : '' !!}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @include('site.includes.feeling_slide', ['images' => $insPhotos])

        @include('site.includes.newsletter')
    </div>
@endsection
