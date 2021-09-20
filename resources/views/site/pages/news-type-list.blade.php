@extends('site.layouts.news-layout')
@section('newsContent')
    @if($featured1ZNewsPost && $featured1ZNewsPost->hasTranslation())
        <div class="new-slide main-content">
            <div class="container">
                <div class="item item-new">
                    <a href="{{ $featured1ZNewsPost->getDetailUrl() }}" title="{{ $featured1ZNewsPost->name }}">
                        <img src="{{ @$featured1ZNewsPost->featured1_image['url'] }}" alt="Banner" title="Banner">
                    </a>
                    <div class="center-slide center-white">
                        @if(($zNewsType = $featured1ZNewsPost->getZNewsType()) && $zNewsType->hasTranslation())
                            <a href="{{ $zNewsType->getDetailUrl() }}"
                               title="{{ $zNewsType->name }}">
                                <span>{{ $zNewsType->name }}</span>
                            </a>
                        @endif
                        <h2>
                            <a href="{{ $featured1ZNewsPost->getDetailUrl()  }}"
                               title="{{ $featured1ZNewsPost->name  }}">{{ $featured1ZNewsPost->name }}</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="section-list-new">
        <div class="container">
            <h3 class="head-high-light-small">{{ setting('site_news.latest_article') }}</h3>
            <div class="list-news">
                <div class="row">
                    @foreach($latestZNewsPosts as $item)
                        @if($item->hasTranslation())
                            <div class="col-md-4">
                                @include('site.includes.news-post-item', ["data" => $item, "large" => true])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @php $i = 0; @endphp
    @foreach($rootZNewsTypes as $item)
        @if($item->hasTranslation())
            @php $zNewsTypesChildren = $item->zNewsTypesChildren; @endphp

            @if(!!$zNewsTypesChildren->count())
                <div class="section-new-destination main-content">
                    <div class="container">
                        <h3 class="head-high-light-small">{{ $item->name }}</h3>
                        <div class="list-news">
                            <div class="owl-carousel owl-theme slider-4">
                                @foreach($zNewsTypesChildren as $zNewsTypesChild)
                                    @if($zNewsTypesChild->hasTranslation())
                                        <div class="new-destinations-item">
                                            <a href="{{ $zNewsTypesChild->getDetailUrl() }}"
                                               title="{{ $zNewsTypesChild->name }}">
                                                <img src="{{ @$zNewsTypesChild->getImageUrl() }}"
                                                     alt="{{ @$zNewsTypesChild->image['title'] }}"
                                                     title="{{ @$zNewsTypesChild->image['alt'] }}">
                                            </a>

                                            <h3>
                                                <a href="{{ $zNewsTypesChild->getDetailUrl() }}"
                                                   title="{{ $zNewsTypesChild->name }}">{{ $zNewsTypesChild->name }}</a>
                                            </h3>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $excerptZNewsPostIds = (!empty($excerptZNewsPostIds) ? $excerptZNewsPostIds : []);
                    $zNewsPostsLatest = $item->zNewsPostsLatest($excerptZNewsPostIds, 1, 4)->get();
                @endphp

                <div class="section-list-new">
                    <div class="container">
                        <h3 class="head-high-light-small">{{ $item->name }}</h3>
                        <div class="list-news">
                            <div class="row">
                                @foreach($zNewsPostsLatest as $item)
                                    @if($item->hasTranslation())
                                        <div class="col-md-3">
                                            @include('site.includes.news-post-item', ["data" => $item, "noContent" => true])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($i == 1 && $featured2ZNewsPost && $featured2ZNewsPost->hasTranslation())
                <div class="clear-both"></div>
                <div class="container-small">
                    <div class="new-high-light">
                        <div class="row">
                            <div class="col-md-6 new-high-light-left">
                                <a href="{{ $featured2ZNewsPost->getDetailUrl() }}"
                                   title="{{ $featured2ZNewsPost->name }}">
                                    <img src="{{ @$featured2ZNewsPost->featured2_image['url'] }}"
                                         alt="{{ @$featured2ZNewsPost->featured2_image['alt'] }}"
                                         title="{{ @$featured2ZNewsPost->featured2_image['title'] }}">
                                </a>
                            </div>
                            <div class="col-md-6 new-high-light-right">
                                <div class="item-new-content">
                                    @if(($zNewsType = $featured2ZNewsPost->getZNewsType()) && $zNewsType->hasTranslation())
                                        <a class="tip" href="{{ $zNewsType->getDetailUrl() }}"
                                           title="{{ $zNewsType->name }}">{{ $zNewsType->name }}</a>
                                    @endif

                                    <h3>
                                        <a href="{{ $featured2ZNewsPost->getDetailUrl() }}"
                                           title="{{ $featured2ZNewsPost->name }}">{{ $featured2ZNewsPost->name }}</a>
                                    </h3>

                                    <div class="excerpt-new">
                                        {{ $featured2ZNewsPost->excerpt }}
                                    </div>
                                    <a class="read-more-public" href="{{ $featured2ZNewsPost->getDetailUrl() }}"
                                       title="{{ $featured2ZNewsPost->name }}">{{ __('site_global.label_read_more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @php $i++; @endphp
        @endif
    @endforeach
@endsection
