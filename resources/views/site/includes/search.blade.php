<section class="form-search-main">
    <div class="container">
        <h2>{{ setting('site_home.search_head') }}</h2>
        <div class="form-search-popular">
            <span>{{ setting('site_home.search_most_popular') }}</span>
            @foreach($zPopularKeys as $zPopularKey)
                @if($zPopularKey->hasTranslation())
                    <a class="popular-active" href="{{ $zPopularKey->url }}"
                       title="{{ $zPopularKey->name }}" target="_blank">{{ $zPopularKey->name }}</a>
                @endif
            @endforeach
        </div>
        <form class="form-searh-main-list" action="{{ localeRoute("special_offers") }}" method="GET">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="dropdown dropdown-search my-dropdown">
                                <button class="btn dropdown-toggle my-dropdown-button" type="button">
                                    {{ __('site_global.label_destinations') }}
                                </button>
                                <i class="fa fa-chevron-down2">
                                    <svg class="icon-down-chevron" width="17" height="17">
                                        <use xlink:href="#down-chevron"></use>
                                    </svg>
                                </i>
                                <div class="dropdown-menu dropdown-menu-destination my-dropdown-menu">
                                    @foreach($zDestinations as $zDestination)
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <label class="container-checkbox">{{ $zDestination->name }}
                                                <input type="checkbox" name="destinations[]"
                                                       value="{{ $zDestination->getKey() }}"
                                                       data-destination="{{ $zDestination->name }}"
                                                       class="input-destination"
                                                       data-destination_text="{{ __('site_global.label_destinations') }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="dropdown dropdown-search search-date">
                                <input type="date" class="dropdown-toggle search-date-input"
                                       placeholder="{{ __('site_global.label_check_in') }}" name="date">
                                <i class="fa fa-chevron-down2">
                                    <svg class="icon-down-chevron" width="17" height="17">
                                        <use xlink:href="#down-chevron"></use>
                                    </svg>
                                </i>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="dropdown dropdown-search my-dropdown">
                                <input type="text" class="dropdown-toggle search-duration-input" readonly
                                       value="{{ __('site_global.label_any_text_search') }}" data-value="">
                                <input type="hidden" name="durations[]" class="duration-value">
                                <i class="fa fa-chevron-down2">
                                    <svg class="icon-down-chevron" width="17" height="17">
                                        <use xlink:href="#down-chevron"></use>
                                    </svg>
                                </i>

                                <div class="dropdown-menu dropdown-menu-duration my-dropdown-menu">
                                    <a class="dropdown-item"
                                       data-text-value="{{ __('site_global.label_any_text_search') }}" data-value="">
                                        {{ __('site_global.label_any_text_search') }}
                                    </a>
                                    @foreach($zDurations as $zDuration)
                                        <a class="dropdown-item" data-text-value="{{ $zDuration->name }}"
                                           data-value="{{ $zDuration->getKey() }}">
                                            {{ $zDuration->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="col-md-3 col-sm-6 wrapper-search-passenger">--}}
                        {{--                            <div class="dropdown dropdown-search my-dropdown dropdown-search-passengers">--}}
                        {{--                                <button class="btn dropdown-toggle my-dropdown-button" type="button">--}}
                        {{--                                    {{ __('site_global.label_passengers') }} <i class="fa fa-chevron-down"></i>--}}
                        {{--                                </button>--}}
                        {{--                                <div class="my-dropdown-menu-passenger ">--}}
                        {{--                                    <div class="dropdown-menu dropdown-menu-passenger my-dropdown-menu ">--}}
                        {{--                                        <div class="cabin-content">--}}
                        {{--                                            <div class="row cabin-search-head">--}}
                        {{--                                                <input type="hidden" value="translate" class="translate-search"--}}
                        {{--                                                       data-label_cabin="{{ __('site_global.label_cabin') }}"--}}
                        {{--                                                       data-label_adults="{{ __('site_global.label_adults') }}"--}}
                        {{--                                                       data-label_child="{{ __('site_global.label_child') }}"--}}
                        {{--                                                       data-label_infant="{{ __('site_global.label_infant') }}"--}}
                        {{--                                                       data-label_add_more_cabin="{{ __('site_global.label_add_more_cabin') }}"--}}
                        {{--                                                       data-label_done="{{ __('site_global.label_done') }}"--}}
                        {{--                                                       data-label_remove="{{ __('site_global.label_remove') }}"--}}
                        {{--                                                       data-label_room="{{ __('site_global.label_room') }}"--}}
                        {{--                                                >--}}

                        {{--                                                <h4 class="col-md-6">{{ __('site_global.label_cabin') }}--}}
                        {{--                                                    1</h4>--}}
                        {{--                                                --}}{{--                                                <div class="delete-cabin col-md-6"><span>REMOVE</span></div>--}}
                        {{--                                            </div>--}}

                        {{--                                            <div class="cabin-detail-list">--}}
                        {{--                                                <div class="number">--}}
                        {{--                                                    <span class="minus">-</span>--}}
                        {{--                                                    <input type="text" readonly class="choose-number adult-number"--}}
                        {{--                                                           value="2" min="0"--}}
                        {{--                                                           max="999"/>--}}
                        {{--                                                    <span class="cabin-sub-text"--}}
                        {{--                                                    >{{ __('site_global.label_adults') }} (12+ yrs)</span>--}}
                        {{--                                                    <span class="plus">+</span>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="number">--}}
                        {{--                                                    <span class="minus">-</span>--}}
                        {{--                                                    <input type="text" readonly class="choose-number child-number"--}}
                        {{--                                                           value="0" min="0"--}}
                        {{--                                                           max="999"/>--}}
                        {{--                                                    <span class="cabin-sub-text">{{ __('site_global.label_child') }} (6-11 yrs)</span>--}}
                        {{--                                                    <span class="plus">+</span>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="number">--}}
                        {{--                                                    <span class="minus">-</span>--}}
                        {{--                                                    <input type="text" readonly class="choose-number infant-number"--}}
                        {{--                                                           value="0" min="0"--}}
                        {{--                                                           max="999"/>--}}
                        {{--                                                    <span class="cabin-sub-text"--}}
                        {{--                                                    >{{ __('site_global.label_infant') }} (0-5 yrs)</span>--}}
                        {{--                                                    <span class="plus">+</span>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="add-more-cabin">--}}
                        {{--                                                        <span--}}
                        {{--                                                            class="add-more-cabin-action">+ <u>{{ __('site_global.label_add_more_cabin') }}</u></span>--}}
                        {{--                                            <button class="close-search">{{ __('site_global.label_done') }}--}}
                        {{--                                            </button>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-3 find-cruise-wrapper">
                    <button type="submit" class="find-cruise">{{ __('site_global.label_find_cruise') }}</button>
                </div>
            </div>
        </form>
    </div>
</section>
