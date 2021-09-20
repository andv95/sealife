@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="page-default">
        <div class="new-slide main-content">

            <div class="item item-new">
                <a href="{{ @$page->images[0]['url'] }}"
                   title="{{ @$page->images[0]['title'] }}">
                    <img src="{{ @$page->images[0]['url'] }}"
                         alt="{{ @$page->images[0]['alt'] }}"
                         title="{{ @$page->images[0]['title'] }}">
                </a>
                <div class="center-slide center-white">
                    <h2>{{ @$page->titles[0] }}</h2>
                    <p>{!! @$page->titles[1] !!}</p>
                </div>
            </div>
        </div>

        <div id="page-default-content">
            <div class="container-small">
                {!! @$page->contents[0] !!}
            </div>
        </div>

        @include('site.includes.newsletter')

    </div>
@endsection

