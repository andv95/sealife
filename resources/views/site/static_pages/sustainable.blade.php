@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="sustainable-page" class="hr-page">
        <div class="container">
            <h1 class="page-title" itemprop="headline name">{{ @$page->titles['0'] }}</h1>
            <div class="about-us-list-item about-us-list-item-image-right">
                <div class="about-us-image-list about-us-height">
                    <img src="{{ $page->getImageUrl('about-us-list', $page->images[0]['url']) }}"
                         title="{{ $page->images[0]['title'] }}"
                         alt="{{ $page->images[0]['alt'] }}">
                </div>
                <div class="about-us-content about-us-height">
                    <h2 class="about-us-title">{{ @$page->titles['1'] }}</h2>
                    <div class="about-us-content-detail">
                        {!! @$page->contents['0'] !!}
                    </div>
                </div>
                <div class="clear-both"></div>
            </div>

            <div class="sustainable-list">
                <div class="row">
                    @for($i=2; $i<=15; $i++)
                        @if(!empty(@$page->images[$i-1]) && !empty(@$page->titles[$i]))
                            <div class="col-md-3">
                                <div class="sustainable-item">
                                    <img src="{{ $page->getImageUrl('sustainable-list', @$page->images[$i-1]['url']) }}"
                                         title="{{ @$page->images[$i-1]['title'] }}"
                                         alt="{{ @$page->images[$i-1]['alt'] }}">
                                    <h2>{{ @$page->titles[$i] }}</h2>
                                    <div class="sustainable-item-detail">
                                        {!!  @$page->contents[$i-1] !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        @php
            $insPhotos = \App\Models\ZInsPhoto::getArrayActiveAndKeyByPosition();
        @endphp
        @include('site.includes.feeling_slide', ['images' => $insPhotos])
        @include('site.includes.newsletter')

    </div>
@endsection

