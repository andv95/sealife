<div class="bar-menu-main">
    <i class="fas fa-bars">
        <svg class="icon-menu" width="20" height="20">
            <use xlink:href="#menu"></use>
        </svg>
        <svg class="icon-close-button" width="20" height="20">
            <use xlink:href="#close-button"></use>
        </svg>
    </i>
</div>
<div class="main-menu-wrapper">
    {!! menu("main_menu", ['start_tag' => '<ul class="main-menu-page">', 'end_tag' => '</ul>']) !!}
    <div class="menu-head-phone show-on-mobile">
        <span>{{ __('site_global.label_hot_line') }}: </span>
        <a href="tel:{{ str_replace(' ', '', setting("site.phone_1")) }}"
           title="phone">{{ setting("site.phone_1") }}</a>
        -
        <a href="tel:{{ str_replace(' ', '', setting("site.phone_2")) }}"
           title="phone">{{ setting("site.phone_2") }}</a>
    </div>
    <div class="clear-both"></div>
    {{--            <div class="lang-menu-mobile show-on-mobile">--}}
    {{--                @include('site.includes.language_list')--}}
    {{--            </div>--}}
</div>
