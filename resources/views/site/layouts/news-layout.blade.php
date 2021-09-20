@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="news-page">
        <section class="high-light new-head-description">
            <div class="container">
                <h1 itemprop="headline name" class="head-high-light head-high-light-love">{!! setting('site_news.head_news_page') !!}</h1>
                <div class="content-text-high-light">
                    {{ setting('site_news.content_news_page') }}
                </div>
            </div>
        </section>

        <div class="container-small">
            <div class="new-destinations">
                <ul>
                    @foreach($rootZNewsTypes as $item)
                        @if($item->hasTranslation())
                            <li @if($item->isCurrentUrl()) class="active-new" @endif>
                                <a href="{{ $item->getDetailUrl() }}" title="{{ $item->name }}">{{ $item->name }}</a>

{{--                                <ul>--}}
{{--                                    <li class="active-new-inside">--}}
{{--                                        <a href="http://127.0.0.1:8000/news-categories/destinations"--}}
{{--                                           title="Destinations">Destinations</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="http://127.0.0.1:8000/news-categories/travel-tips" title="Travel tips">Travel--}}
{{--                                            tips</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </li>
                        @endif
                    @endforeach
                    <li class="clear-both"></li>
                </ul>
            </div>
        </div>

        @yield("newsContent")

        @include('site.includes.newsletter')
    </div>
@endsection
