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

    <div class="section-list-new js_news_type_posts">
        <input type="hidden" class="js_news_type_posts_current_page" value="1">
        <div class="container">
            <h3 class="head-high-light-small">{{ $data->name }}</h3>
            <div class="list-news">
                <div class="row js_news_type_posts_content">
                    @include("site.includes.news-post-items", ["zNewsPosts" => $dataPosts])
                </div>
            </div>

            @if($nextPage)
                <div class="load-more-news mt-5 text-center js_news_type_posts_load_more">
                    <a href="javascript:void(0);" class="btn btn-success btn-sm"
                       title="{{ __("site_global.label_load_more") }}"
                       data-url="{{ localeRoute("news_types.get_more_posts") }}"
                       data-news-type-id="{{ $data->getKey() }}">{{ __("site_global.label_load_more") }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ site_asset('js/z_news_type.js?v="'.rand(1,9999).'"') }}"></script>
@stop
