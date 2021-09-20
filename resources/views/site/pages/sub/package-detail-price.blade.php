@if($date)
    <div class="check-availability-rate">
        <p>{{ __('site_global.label_starting_from') }}:</p>

        <h3>{!! $zPackage->getMinPriceByDateText($date) !!}</h3>
        @if(!isset($id_pk_nha_hang) || $id_pk_nha_hang != $zPackage->id)
            <ul class="package-list-offer">
                <li>{{ __('site_global.label_cabin') }}:
                    @if($zPackage->getMinPriceByDate($date)["zRoom"])
                        <span>{{ $zPackage->getMinPriceByDate($date)["zRoom"]->name }}</span>
                    @endif
                </li>
                <li>{{ __('site_global.text_price_for') }}:
                    <span>{{ $zPackage->getMinPriceByDate($date)["roomDesc"] }} </span></li>
            </ul>
            <button type="submit"
                    class="button-public">{{ __('site_global.label_reserve_now') }}</button>
        @else
            <button type="submit"
                    class="button-public">{{ __('site_global.text_button_reserve_now') }}</button>
        @endif

        <div class="package-view-more">
            <a href="#room-slider"
               title="{{ setting('site_package.viewMorePriceOptions') }}"
               class="read-more-public">{{ setting('site_package.viewMorePriceOptions') }}</a>
        </div>
    </div>
@else
    @include('site.includes.choose-date-show-price')
@endif
