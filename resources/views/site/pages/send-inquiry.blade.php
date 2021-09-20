@extends('site.layouts.master_full_content')
@section('styles')
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
@endsection
@section('content-full')
    <div id="send-inquiry-page" class="hr-page js_inquiry_refresh_url"
         data-refresh-url="{{ localeRoute("packages.refresh_send_inquiry") }}">
        <div class="container">
            <h1 class="page-title" itemprop="headline name">{{ $zPackage->name }}</h1>
            <div class="row">
                <div class="col-lg-8 send-inquiry-left">
                    <div id="js_form_send_inquiry_message" class="mb-5"></div>
                    <form class="js_send_inquiry_form" action="{{ localeRoute('packages.post_send_inquiry') }}"
                          method="post">
                        @csrf

                        <input type="hidden" name="z_package_id" id="js_inquiry_input_package_id"
                               value="{{ $zPackage->getKey() }}">
                        <input type="hidden" name="is_flexible_promotion" id="js_inquiry_input_is_flexible_promotion"
                               value="{{ (int)$isFlexiblePromotion }}">

                        <div class="section-change-inquiry">
                            <h3>{{ setting('site_inquiry.1_review_inquiry') }}</h3>
                            <div class="row send-inquiry-1 si-date">
                                <p class="col-md-3 inquiry-text-left col-4">
                                    <span>{{ __('site_global.label_departures') }}:</span>
                                </p>
                                <div class="col-md-9 col-8 inquiry-input-right">
                                    <input type="text" class="my-date input-full" readonly value="{{ $dateFormat }}">
                                    <input type="hidden" name="start_date" value="{{ $date }}"
                                           class="my-date-render js_inquiry_refresh_url_select"
                                           id="js_inquiry_input_start_date">
                                    <span
                                        class="inquiry_change_input show-on-desktop">{{ __('site_global.label_change_date') }}</span>
                                    <span
                                        class="inquiry_change_input show-on-mobile">{{ __('site_global.label_change') }}</span>
                                </div>
                            </div>
                            <div class="row send-inquiry-1 si-date">
                                <p class="col-md-3 col-4 inquiry-text-left">
                                    <span>{{ __('site_global.label_return') }}:</span>
                                </p>
                                <div class="col-md-9 col-8 inquiry-input-right">
                                    <input type="text" class="input-full js_inquiry_return_date_format_render" readonly
                                           value="{{ $returnDateFormat }}">
                                </div>
                            </div>
                            <div class="row send-inquiry-1">
                                <p class="col-md-3 col-4 inquiry-text-left staying-in-text">
                                    <span>{{ __('site_global.label_stay_in') }}:</span>
                                </p>
                                <div class="col-md-9 col-8 inquiry-input-right send-inquiry-stay-in">
                                    <select name="z_room_api_id" id="js_inquiry_input_z_room_id_id"
                                            class="input-full js_inquiry_refresh_url_select input-select2">
                                        @foreach($zRooms as $zRoom)
                                            @if($zRoom->hasTranslation() && $zRoom->api_id)
                                                <option value="{{ $zRoom->api_id }}"
                                                        @if($roomId === $zRoom->api_id) selected @endif>
                                                    {{ $zRoom->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="inquiry_change_input">{{ __('site_global.label_change') }}</span>
                                </div>
                            </div>
                            <div class="row send-inquiry-1">
                                <p class="col-md-3 col-4 inquiry-text-left inquiry-text-left-center">
                                    <span>{{ __('site_global.label_number_of_room') }}:</span></p>
                                <div class="col-md-9 col-8 inquiry-input-right number-of-room number">
                                    <span class="minus js_inquiry_button_change_number_of_room">-</span>
                                    <input type="number" name="number_of_room" value="{{ $numberOfRoomText }}" min="1"
                                           max="99"
                                           class="choose-number" id="js_inquiry_input_number_of_room" readonly
                                           data-price-per-room="{{ $priceFloatPerRoom }}">
                                    <span class="plus js_inquiry_button_change_number_of_room">+</span>
                                </div>
                            </div>
                            <div class="row send-inquiry-1">
                                <p class="col-md-3 inquiry-text-left inquiry-text-left-center">
                                    <span>{{ __('site_global.label_number_of_guest') }}:</span></p>
                                <div class="col-md-9 inquiry-input-right number-of-guest">
                                    <div class="row">
                                        <div class="col-md-4 inquiry-guest">
                                            <span>{{ __('site_global.label_adults') }}</span>

                                            <select name="quantity_adults"
                                                    class="input-select2 js_inquiry_number_of_customer"
                                                    id="js_inquiry_number_of_adult">
                                                @for($i = 1; $i < 10; $i++)
                                                    <option value="{{ $i }}">{{ "0".$i }}</option>
                                                @endfor
                                            </select>
                                            <i class="fa fa-chevron-down down-inquiry"></i>
                                        </div>
                                        <div class="col-md-4 inquiry-guest">
                                            <span>{{ __('site_global.label_children_2') }}</span>

                                            <select name="quantity_children"
                                                    class="input-select2 js_inquiry_number_of_customer"
                                                    id="js_inquiry_number_of_children">
                                                @for($i = 0; $i < 10; $i++)
                                                    <option value="{{ $i }}">{{ "0".$i }}</option>
                                                @endfor
                                            </select>
                                            <i class="fa fa-chevron-down down-inquiry"></i>
                                        </div>
                                        <div class="col-md-4 inquiry-guest">
                                            <span>{{ __('site_global.label_infant') }}</span>

                                            <select name="quantity_infants"
                                                    class="input-select2 js_inquiry_number_of_customer"
                                                    id="js_inquiry_number_of_infant">
                                                @for($i=0; $i < 10; $i++)
                                                    <option value="{{ $i }}">{{ "0".$i }}</option>
                                                @endfor
                                            </select>
                                            <i class="fa fa-chevron-down down-inquiry"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="package-inquiry">
                            <div class="row">
                                <div class="col-md-9 col-8 package-inquiy-detail">
                                    <h3>
                                        {{ __('site_global.label_estimated_room_rate') }} (<span
                                            class="js_inquiry_promotion_text_render">{{ $promotionText }}</span>)
                                    </h3>

                                    @foreach($zPackage->zOffersActive as $zOffer)
                                        @if($zOffer->hasTranslation())
                                            @include("site.includes.package-offer-item", ["item" => $zOffer, "loop" => $loop])
                                        @endif
                                    @endforeach

                                </div>
                                <div class="col-md-3 col-4 package-inquiry-price">
                                    <span class="js_inquiry_promotion_price_render">{!! $promotionPrice !!}</span>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>

                        @if(!!$transfers->count())
                            <div class="transfer-service">
                                <h3>{{ setting('site_inquiry.2_transfer_service') }}</h3>
                                @foreach($transfers as $transfer)
                                    @if($transfer->hasTranslation())
                                        <input type="radio" value="{{ $transfer->getKey() }}" name="transfer"
                                               @if($loop->first) checked
                                               @endif id="transfer_{{ $transfer->getKey() }}">
                                        <label
                                            for="transfer_{{ $transfer->getKey() }}">{{ $transfer->name }} </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="inquiry-form">
                            <h3>{{ setting('site_inquiry.3_contact_detail') }}</h3>
                            <p class="inquiry-form-text">
                                {{ setting('site_inquiry.3_contact_content') }}
                            </p>

                            <div id="form-submit-inquiry">
                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <div class="row">
                                            <label class="control-label col-sm-7"
                                                   for="title">{{ __('site_global.label_title') }}
                                                <span>*</span>:</label>
                                            <div class="col-sm-5 inquiry-title  select-title">
                                                <select name="title" id="title" class="form-control input-select2">
                                                    @foreach($titles as $title)
                                                        <option
                                                            value="{{ $title }}">{{ __('admin_table.z_inquiries.option_title_'.$title) }}</option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-chevron-down down-inquiry"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-7 form-inquiry-name">
                                        <div class="row">
                                            <label class="control-label col-sm-4 inquiry-label-name"
                                                   for="name">{{ __('site_global.label_name') }}<span>*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3"
                                           for="country">{{ __('site_global.label_country') }}
                                        <span>*</span>:</label>
                                    <div class="col-sm-9 input-padding-left0 select-country">
                                        <select name="country" id="country" class="form-control input-select2-search">
                                            <option value="">{{ __('site_global.label_select_country') }}</option>

                                            @foreach($countries as $country)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa fa-chevron-down down-inquiry"></i>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3" for="email">Email<span>*</span>:</label>
                                    <div class="col-sm-9 input-padding-left0">
                                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                                               name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3"
                                           for="confirm-email">{{ __('site_global.label_confirm_email') }}
                                        <span>*</span>:</label>
                                    <div class="col-sm-9 input-padding-left0">
                                        <input type="email" class="form-control" name="confirm_email"
                                               id="confirm-email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3"
                                           for="phone">{{ __('site_global.label_phone_number') }}:</label>
                                    <div class="col-sm-9 input-padding-left0">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               placeholder="{{ __('site_global.placeholder_phone_number') }}">
                                    </div>
                                </div>

                                <div class="form-group row inquiry-textarea">
                                    <label class="control-label col-sm-3"
                                           for="special-request">{{ __('site_global.label_special_request') }}:</label>
                                    <div class="col-sm-9 input-padding-left0">
                                    <textarea rows="6" cols="50" id="special-request" class="form-control"
                                              placeholder="{{ __('site_global.placeholder_special_request') }}"
                                              name="special_request"></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-captcha">
                                    <div class="row">
                                        <label for="captcha" class="control-label col-sm-3"></label>
                                        <div class=" col-sm-9 input-padding-left0">
                                            {!! NoCaptcha::renderJs(\App\Models\Language::getCurrentLanguageKey()) !!}
                                            {!! NoCaptcha::display() !!}
                                            <span
                                                class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row submit-btn-inquiry">
                                    <label class="control-label col-sm-3"></label>
                                    <div class="col-sm-9 input-padding-left0">
                                        <input type="submit" class="form-control button-public"
                                               value="{{ __('site_global.button_send_inquiry') }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-4 send-inquiry-right">
                    <div class="send-inquiry-right-content">
                        <div class="send-inquiry-right-info">
                            <h3 class="section-title">{{ __('site_global.label_my_trip') }}</h3>
                            <h4>{{ $zPackage->name }}</h4>
                            <p class="inquiry-cruise-start">{{ __('site_global.label_cruise_starts') }}:
                                <strong class="js_inquiry_date_format_render">
                                    {{ $dateFormat }}
                                </strong>
                            </p>
                            <p class="inquiry-cruise-end">{{ __('site_global.label_cruise_ends') }}:
                                <strong class="js_inquiry_return_date_format_render">
                                    {{ $returnDateFormat }}
                                </strong>
                            </p>
                            <p class="inquiry-guest">{{ __('site_global.label_guests') }}:
                                <strong>
                                    <span class="js_inquiry_num_of_adult_render"
                                          data-label="{{ __('site_global.label_adult_2') }}"
                                          data-labels="{{ __('site_global.label_adults_2') }}"></span>
                                    <span class="js_inquiry_num_of_children_render"
                                          data-label="{{ __('site_global.label_child_2') }}"
                                          data-labels="{{ __('site_global.label_children_2') }}"></span>
                                    <span class="js_inquiry_num_of_infant_render"
                                          data-label="{{ __('site_global.label_infant_2') }}"
                                          data-labels="{{ __('site_global.label_infants_2') }}"></span>
                                </strong>
                            </p>
                            <p class="inquiry-stay-in">{{ __('site_global.label_stay_in') }}:
                                <strong class="js_inquiry_room_name_render">
                                    {{ $selectingZRoom->name }}
                                </strong>
                            </p>
                        </div>
                        <div class="send-inquiry-right-transfer">
                            <p><strong>Transfer & Add-on services</strong></p>

                            @foreach($zPackage->zOffersActive  as $zOffer)
                                @if($zOffer->hasTranslation())
                                    <p class="inquiry-transfer-item">
                                        {{ $zOffer->name }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        <div class="send-inquiry-right-includes">
                            <p><strong>{{ __('site_global.label_include') }}:</strong></p>
                            <p>{!! $zPackage->price_inclusion !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @include('site.includes.newsletter')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ site_asset('js/send_inquiry.js?v="'.rand(1,9999).'"') }}"></script>
@stop
