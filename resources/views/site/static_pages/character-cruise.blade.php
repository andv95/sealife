@extends('site.layouts.master_full_content')
@section('body_class', 'banner-menu')
@section('styles')
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
@endsection
@section('content-full')
    <div id="character-cruise">
        <div class="main-content" id="main-content">
            <div class="banner-cruise">
                @php
                    $zBanner = \App\Models\ZBanner::getListActiveByType(\App\Models\ZBanner::TYPE_CHARACTER);
                @endphp
                @include('site.includes.banner-cruise', ['zBanner' => $zBanner])
            </div>
        </div>

        <div class="container character-cruise-factsheet">
            <h2 class="section-title">{{ @$page->titles[0] }}</h2>
            <div class="list-service-cruise">
                @for($i=0; $i<=2; $i++)
                    <div class="list-service-item">
                        @php
                            $title = @$page->images[$i]['title'];
                            $titleArr = explode(',', $title);
                        @endphp
                        <img src="{{ $page->images[$i]['url'] }}" alt="{{ $page->images[$i]['alt'] }}"
                             title="{{ $page->images[$i]['title'] }}">
                        <div class="list-service-item-detail">
                            <h3>{{ @$titleArr[0] }}</h3>
                            <p>{{ @$titleArr[1] }}</p>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                @endfor
            </div>
            <div class="clear-both"></div>
            <div class="character-cruise-factsheet-wrapper">
                <a href="" title="factsheet" download=""
                   class="button-public">{{ __('site_global.label_factsheet') }}</a>
            </div>
        </div>

        <div class="about-us-list">
            <div class="container">
                @for($i = 8; $i < 20; $i++)
                    @if(!empty($page->images[$i]) && !empty($page->contents[$i-8]))
                        <div
                            class="about-us-list-item {{ $i%2==0 ? 'about-us-list-item-image-left' : 'about-us-list-item-image-right' }}">
                            <div class="about-us-image-list about-us-height">
                                <img src="{{ $page->getImageUrl('character-cruise', @$page->images[$i]['url']) }}"
                                     title="{{ @$page->images[$i]['title'] }}"
                                     alt="{{ @$page->images[$i]['alt'] }}">
                            </div>
                            <div class="about-us-content about-us-height">
                                <div class="about-us-center">
                                    <h2 class="about-us-title">{{ @$page->images[$i]['title'] }}</h2>
                                    <div class="about-us-content-detail">
                                        {!! $page->contents[$i-8] !!}
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>

        <div class="our-client">
            <div class="container">
                <h2 class="section-title">{{ $page->titles['1'] }}</h2>
                <div class="our-client-detail main-content">
                    <div class="owl-carousel slider-5 owl-theme">
                        @for($client = 3; $client<=7; $client++)
                            <div class="item">
                                <img src="{{ $page->getImageUrl('our-client', @$page->images[$client]['url']) }}"
                                     alt="{{  @$page->images[$client]['alt'] }}"
                                     title="{{  @$page->images[$client]['title'] }}">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="cruise-contact">
            <div class="container-small">
                <h2 class="section-title">{!! @$page->titles[2] !!}</h2>
                <form class="js_event_form" id="captcha-form" action="{{ route("site.ajax.event") }}" method="POST">
                    @csrf

                    <div id="js_form_event_message"></div>

                    <div class="row">
                        <div class="col-md-6 cruise-contact-left">
                            <p>{{ @$page->titles[3] }}</p>
                            @php
                                $services = @$page->titles[4];
                                $serviceArr = explode(',', $services);
                            @endphp
                            <ul class="cruise-service">
                                @foreach($serviceArr as $service)
                                    <li>
                                        <input type="radio" name="service" value="{{ $service }}"
                                               @if($loop->first) checked @endif />
                                        {{ $service }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6 cruise-contact-right">
                            <div class="cruise-form">
                                <div class="form-group">
                                    <label class="control-label"
                                           for="group_size">{{ __('site_global.label_group_size') }}
                                        <span>*</span>:</label>
                                    <div class="input-padding-left0">
                                        <input type="number" class="form-control" name="group_size"
                                               id="group_size">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"
                                           for="email">{{ __('site_global.label_contact_email') }}
                                        <span>*</span>:</label>
                                    <div class="input-padding-left0">
                                        <input type="email" class="form-control" name="email"
                                               id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"
                                           for="event_detail">{{ __('site_global.label_event_detail') }}:</label>
                                    <div class="input-padding-left0">
                                        <textarea type="text" class="form-control" name="event_detail"
                                                  id="event_detail"></textarea>
                                        {{--                                        <input type="text" class="form-control" name="event_detail"--}}
                                        {{--                                               id="event_detail">--}}
                                    </div>
                                </div>
                                <div class="form-group form-captcha">
                                        <label for="captcha" class="control-label"></label>
                                        <div class=" input-padding-left0">
                                            {!! NoCaptcha::renderJs(\App\Models\Language::getCurrentLanguageKey()) !!}
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                </div>
                                <div class="cruise-button">
                                    <input type="submit" value="{{ __('site_global.button_submit') }}"
                                           class="button-public">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('site.includes.feeling_slide', [
            'images' => \App\Models\ZInsPhoto::getArrayActiveAndKeyByPosition()
        ])
        @include('site.includes.newsletter')

    </div>
@endsection

@section("scripts")
    <script src="{{ site_asset('js/character_cruise.js?v="'.rand(1,9999).'"') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
@stop

