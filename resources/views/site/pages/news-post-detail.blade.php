@extends('site.layouts.master_full_content')
@section('first-body')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0"
            nonce="fkBVmSSC"></script>
@endsection
@section('content-full')
    <div id="news-detail-page">
        @if($dataZNewsType && $dataZNewsType->hasTranslation())
            <div class="new-slide main-content">
                <div class="owl-carousel owl-theme slider-1">
                    <div class="item item-new new-list-banner">
                        <img src="{{ @$dataZNewsType->banner_image["url"] }}"
                             alt="{{ @$dataZNewsType->banner_image["alt"] }}"
                             title="{{ @$dataZNewsType->banner_image["title"] }}">
                    </div>
                </div>
            </div>
        @endif

        <div class="new-description">
            <div class="container-small">
                <div class="new-description-detail">
                    <ul class="breadcrumb">
                        <li><a href="{{ localeRoute("news_types.list") }}"
                               title="Blog">{{ __('site_global.label_blog') }} <i
                                    class="fas fa-chevron-right icon-breadcrumb"></i></a></li>
                        @if($dataZNewsType && $dataZNewsType->hasTranslation())
                            <li>
                                <a href="{{ $dataZNewsType->getDetailUrl() }}"
                                   title="{{ $dataZNewsType->name }}">{{ $dataZNewsType->name }} <i
                                        class="fas fa-chevron-right icon-breadcrumb"></i></a>
                            </li>
                        @endif

                        <li>
                            <span>{{ $data->name }}</span>
                        </li>
                    </ul>

                    @if($dataZNewsType && $dataZNewsType->hasTranslation())
                        <a href="{{ $dataZNewsType->getDetailUrl() }}" title="{{ $dataZNewsType->name }}"
                           class="tip new-detail-tip">{{ $dataZNewsType->name }}</a>
                    @endif

                    <h1 class="page-title" itemprop="headline name">{{ $data->name }}</h1>
                    <div class="short-des-post">
                        <p>{{ $data->excerpt }}</p>
                    </div>
                    <div class="new-description-detail-content">
                        {!! $data->content !!}
                    </div>
                    @include('site.pages.rating')
                    <div class="fb-comments" data-href="{{ $data->getDetailUrl() }}" data-width="100%"
                         data-numposts="5"></div>
                </div>
            </div>
        </div>

        <div class="section-list-new">
            <div class="container">
                <h3 class="head-high-light-small">{{ setting('site_news.relate_article') }}</h3>
                <div class="list-news">
                    <div class="row">
                        @foreach($relatedZNewsPosts as $item)
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

        <div class="relate-cruise-in-news">
            <div class="container">
                <h3 class="head-high-light-small">{{ setting('site_news.relate_tours') }}</h3>
            </div>
            @include('site.includes.related-cruise', ["zPackages" => $relatedZPackages])
        </div>

        @include('site.includes.newsletter')
    </div>
@endsection
