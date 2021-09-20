@extends('site.layouts.master_full_content')
@section('styles')
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
@endsection
@section('content-full')
    <div id="contact-us-page">
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
                    {!! @$page->contents[0] !!}
                </div>
            </div>
        </div>

        <div class="distribute-contact container">
            <h2 class="section-title">{{ @$page->titles[1] }}</h2>
            <div class="row list-main-contact-footer">
                <div class="row">
                    @php
                        $zDistributors = \App\Models\ZDistributor::getEloquentList()->orderBy("order_no", "asc")->active()->get();
                        $dc = $zDistributors->count();
                        $tmp = [1=>12,2=>6,3=>4];
                        $column_number = isset($tmp[$dc]) ? $tmp[$dc] : 3;
                    @endphp
                    @foreach($zDistributors as $zDistributor)
                        @if($zDistributor->hasTranslation())
                            <div class="col-md-6 col-lg-{{ $column_number }} col-sm-6 contact-footer">
                                <h5>{{ $zDistributor->name }}</h5>
                                <p>
                                    H: {!! $zDistributor->getPhone() !!}</p>
                                <p> E: <a href="mailto:{{ $zDistributor->email }}"
                                          title="Email">{{ $zDistributor->email }}</a></p>
                                <p> A: {{ $zDistributor->address }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h2 class="section-title">{{ @$page->titles[2] }}</h2>

            <div id="js_form_contact_message" class="mb-2 pt-2"></div>

            <form class="js_contact_form" action="{{ siteRoute("ajax.contact") }}" method="POST">
                @csrf

                <div class="form-group contact-form-detail">
                    <label for="first-name">{{ __('site_global.label_first_name') }}<span class="required-text">*</span></label>
                    <input type="text" class="form-control" id="first-name" name="first_name">
                </div>
                <div class="form-group contact-form-detail">
                    <label for="last-name">{{ __('site_global.label_last_name') }}<span
                            class="required-text">*</span></label>
                    <input type="text" class="form-control" id="last-name" name="last_name">
                </div>
                <div class="form-group contact-form-detail">
                    <label for="email">{{ __('site_global.label_email') }}<span class="required-text">*</span></label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group contact-form-detail">
                    <label for="phone">{{ __('site_global.label_phone') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group contact-form-detail">
                    <label for="looking-travel">{{ __('site_global.label_looking_travel') }}</label>
                    <input type="text" class="form-control" id="looking-travel" name="looking_for"
                           value="{{ request()->input('looking_for') ?: '' }}"
                    >
                </div>
                <div class="form-group contact-form-detail">
                    <label for="interested-in">{{ __('site_global.label_interested_in') }}</label>
                    <input type="text" class="form-control" id="interested-in" name="interested_in">
                </div>
                <div class="form-group contact-form-detail">
                    <label for="anything-else">{{ __('site_global.label_anything_else') }}<span
                            class="required-text">*</span></label>
                    <input type="text" class="form-control" id="anything-else" name="something_else">
                </div>
                <div class="form-group form-captcha">
                    <label for="captcha" class="control-label"></label>
                    <div class=" input-padding-left0">
                        {!! NoCaptcha::renderJs(\App\Models\Language::getCurrentLanguageKey()) !!}
                        {!! NoCaptcha::display() !!}
                        <span
                            class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    </div>
                </div>
                <div class="submit-contact">
                    <input type="submit" class="button-public" value="{{ __('site_global.button_submit') }}">
                </div>
            </form>
        </div>

        @include('site.includes.newsletter')

    </div>
@endsection

@section("scripts")
    <script src="{{ site_asset('js/contact_form.js?v="'.rand(1,9999).'"') }}"></script>
@stop
