<div hidden>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="close-button" viewBox="0 0 26 26"><title>close-button</title>
            <path style="fill:#030104;"
                  d="M21.125,0H4.875C2.182,0,0,2.182,0,4.875v16.25C0,23.818,2.182,26,4.875,26h16.25 C23.818,26,26,23.818,26,21.125V4.875C26,2.182,23.818,0,21.125,0z M18.78,17.394l-1.388,1.387c-0.254,0.255-0.67,0.255-0.924,0 L13,15.313L9.533,18.78c-0.255,0.255-0.67,0.255-0.925-0.002L7.22,17.394c-0.253-0.256-0.253-0.669,0-0.926l3.468-3.467 L7.221,9.534c-0.254-0.256-0.254-0.672,0-0.925l1.388-1.388c0.255-0.257,0.671-0.257,0.925,0L13,10.689l3.468-3.468 c0.255-0.257,0.671-0.257,0.924,0l1.388,1.386c0.254,0.255,0.254,0.671,0.001,0.927l-3.468,3.467l3.468,3.467 C19.033,16.725,19.033,17.138,18.78,17.394z"/>
        </symbol>
        <symbol id="call" viewBox="0 0 384 384"><title>call</title>
            <path
                d="M353.188,252.052c-23.51,0-46.594-3.677-68.469-10.906c-10.719-3.656-23.896-0.302-30.438,6.417l-43.177,32.594 c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208,11.167-20.198,7.635-31.448 c-7.26-21.99-10.948-45.063-10.948-68.583C132.146,13.823,118.323,0,101.333,0H30.813C13.823,0,0,13.823,0,30.813 C0,225.563,158.438,384,353.188,384c16.99,0,30.813-13.823,30.813-30.813v-70.323C384,265.875,370.177,252.052,353.188,252.052z"/>
        </symbol>
        <symbol id="left-chevron" viewBox="0 0 407.436 407.436"><title>left-chevron</title>
            <polygon points="315.869,21.178 294.621,0 91.566,203.718 294.621,407.436 315.869,386.258 133.924,203.718 "/>
        </symbol>
        <symbol id="right-chevron" viewBox="0 0 407.436 407.436"><title>right-chevron</title>
            <polygon points="112.814,0 91.566,21.178 273.512,203.718 91.566,386.258 112.814,407.436 315.869,203.718 "/>
        </symbol>
        <symbol id="up-chevron" viewBox="0 0 407.436 407.436"><title>up-chevron</title>
            <polygon points="203.718,91.567 0,294.621 21.179,315.869 203.718,133.924 386.258,315.869 407.436,294.621 "/>
        </symbol>
        <symbol id="down-chevron" viewBox="0 0 407.437 407.437"><title>down-chevron</title>
            <polygon points="386.258,91.567 203.718,273.512 21.179,91.567 0,112.815 203.718,315.87 407.437,112.815 "/>
        </symbol>
        <symbol id="menu" viewBox="0 0 341.333 341.333"><title>menu</title>
            <g>
                <g>
                    <rect y="277.333" width="341.333" height="42.667"/>
                </g>
            </g>
            <g>
                <g>
                    <rect y="149.333" width="341.333" height="42.667"/>
                </g>
            </g>
            <g>
                <g>
                    <rect y="21.333" width="341.333" height="42.667"/>
                </g>
            </g>
        </symbol>
    </svg>
</div>


<!--    Head top and menu-->
<header>
    <div class="container container-head">
        <div class="row header-row-1">
            <div class="show-on-mobile main-menu-mobile">
                @include('site.components.header-menu')
            </div>
            <div class="col-lg-4 col-sm-4 header-1">
                @include('site.includes.language_list')
            </div>
            <div class="col-lg-4 col-md-4 header-2">
                {!!  !empty($isHome) ? '<h1 itemprop="headline name">' : '' !!}
                <a href="{{ localeRoute('home') }}" title="{{ setting("site.shop_name") }}">
                    <img src="{{ @setting('site.logo')['url'] }}" alt="{{ setting("site.shop_name") }}"
                         title="{{ setting("site.shop_name") }}"
                         class="head-logo" width="150" height="41">
                </a>
                {!!  !empty($isHome) ? '</h1>' : '' !!}
            </div>
            <div class="show-on-mobile language-mobile">
                @include('site.includes.language_list')
            </div>
            <div class="col-lg-4 col-md-8 header-3 show-on-desktop">
                <div class="contact-head">
                    <span class="pr-2">
                        <i class="fa fa-phone-alt phone-main-icon">
                            <svg class="icon" width="13" height="13"><use xlink:href="#call"></use></svg>
                        </i>
                    </span>
                    <span>
                        <a href="tel:{{ str_replace(' ', '', setting("site.phone_1")) }}"
                           title="phone">{{ setting("site.phone_1") }}</a>
                        <a href="tel:{{ str_replace(' ', '', setting("site.phone_2")) }}"
                           title="phone">{{ setting("site.phone_2") }}</a>
                    </span>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
    <div class="show-on-desktop">
        <div class="row header-row-2 main-menu">
            @include('site.components.header-menu')


            {{--            <ul class="main-menu-page">--}}
            {{--                <li class="active"><a href="" title="">HALONG BAY CRUISE</a></li>--}}
            {{--                <li class="has-sub-menu">--}}
            {{--                    <a href="" title="">--}}
            {{--                        NHA TRANG CRUISE--}}
            {{--                    </a>--}}
            {{--                    <ul>--}}
            {{--                        <li><a href="" title="">HALONG CRUISE</a></li>--}}
            {{--                        <li><a href="" title="">Dragon CRUISE</a></li>--}}
            {{--                        <li><a href="" title="">Monkey BAY CRUISE</a></li>--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--                <li><a href="" title="">SPECIAL OFFER</a></li>--}}
            {{--                <li><a href="" title="">GALLERY</a></li>--}}
            {{--                <li><a href="" title="">ABOUT SEALIFE</a></li>--}}

            {{--                <li class="show-on-mobile">--}}
            {{--                    <a href="" title="">--}}
            {{--                        EN--}}
            {{--                    </a>--}}
            {{--                    @php--}}
            {{--                        $allowLanguages = \App\Models\Language::getSupportedLanguageKeys();--}}
            {{--                    @endphp--}}
            {{--                    <ul>--}}
            {{--                        @foreach($allowLanguages as $item)--}}
            {{--                            <li>--}}
            {{--                                <a--}}
            {{--                                    href="{{ LaravelLocalization::getLocalizedURL($item, '/', [], true) }}"--}}
            {{--                                    title="{{ $item }}">{{ strtoupper($item) }}</a>--}}
            {{--                            </li>--}}
            {{--                        @endforeach--}}
            {{--                    </ul>--}}
            {{--                </li>--}}

            {{--            </ul>--}}

        </div>
    </div>
</header>
