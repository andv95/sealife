<section class="high-light high-light-email ">
    <div class=" background-van-van-email">
        <h2 class="head-high-light">{{ setting('site_home.newsletter_head') }}</h2>
        <p class="sub-head-high-light">{{ setting('site_home.newsletter_sub') }}</p>
        <div class="content-text-high-light">
            <form class="new-letter js_site_newsletter_form" action="{{ siteRoute("ajax.newsletter") }}" method="POST">
                @csrf

                <input type="email" required class="email-new-letter" name="mail_address"
                       placeholder="{{ __('site_global.label_mail_address_plh') }}">
                <input type="submit" class="button-public submit-email-new-letter"
                       value="{{ __('site_global.button_submit') }}">

                <div class="form-group form-captcha">
                    <input type="text" name="name" value="" class="d-none">
                    <div class=" input-padding-left0">
{{--                        {!! NoCaptcha::renderJs(\App\Models\Language::getCurrentLanguageKey()) !!}--}}
{{--                        {!! NoCaptcha::display() !!}--}}
                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    </div>
                </div>
                <p class="text-left js_site_newsletter_message message-result"></p>
            </form>
        </div>
        <div class="social-list">
            <a href="{{ setting('site.social_fb') }}" title="facebook" class="facebook">
                <img loading="lazy" width="32" height="33" src="{{ site_asset('image/icons/facebook.png') }}" alt="facebook" title="facebook" class="social-icon">
                <img loading="lazy" width="32" height="33" src="{{ site_asset('image/icons/facebook_hover.png') }}" alt="facebook" title="facebook" class="social-icon-hover">
            </a>
            <a href="{{ setting('site.social_tw') }}" title="twitter" class="twitter">
                <img loading="lazy" width="33" height="33" src="{{ site_asset('image/icons/twitter.png') }}" alt="twitter" title="twitter" class="social-icon">
                <img loading="lazy" width="33" height="33" src="{{ site_asset('image/icons/twitter_hover.png') }}" alt="twitter" title="twitter" class="social-icon-hover">
            </a>
            <a href="{{ setting('site.social_yt') }}" title="youtube" class="youtube">
                <img loading="lazy" width="34" height="33" src="{{ site_asset('image/icons/youtube.png') }}" alt="youtube" title="youtube" class="social-icon">
                <img loading="lazy" width="34" height="33" src="{{ site_asset('image/icons/youtube_hover.png') }}" alt="youtube" title="youtube" class="social-icon-hover">
            </a>
            <a href="{{ setting('site.social_ins') }}" title="instagram" class="instagram">
                <img loading="lazy" width="33" height="33" src="{{ site_asset('image/icons/instar_1.png') }}" alt="instagram" title="instagram" class="social-icon">
                <img loading="lazy" width="33" height="33" src="{{ site_asset('image/icons/instar_1_hover.png') }}" alt="instagram" title="instagram" class="social-icon-hover">
            </a>
        </div>
    </div>
</section>
