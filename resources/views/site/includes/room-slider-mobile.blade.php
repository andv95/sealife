<div
    class="main-content owl-custom-button owl-custom-button-remove owl-package owl-mobile-number head-slide-package-room">
    <div id="sync2" class="owl-carousel owl-theme">
        @foreach($rooms as $room)
            @if($room['z_room']->hasTranslation())
                <div class="item owl-number-custom " data-index-number="{{ $loop->index + 1 }}">
                    @include('site.includes.item-room-package', ['zRoom' => $room['z_room']])
                </div>
            @endif
        @endforeach
    </div>
    @if($rooms->count()>5)
        <button class="custom-back disabled">‹</button>
        <button class="custom-next">›</button>
    @endif
    @if(!!$countItem = $rooms->count())
        <div class="owl-number show-on-mobile">
            <span class="owl-number-prev">← </span>
            <span class="owl-number-item-active">01</span>/<span
                class="owl-number-total">{{ \App\Helpers\Helper::addZeroToNumber($countItem) }}</span>
            <span class="owl-number-next"> →</span>
        </div>
    @endif
</div>
<div id="sync1" class="owl-carousel owl-theme">
    @foreach($rooms as $room)
        @if($room['z_room']->hasTranslation())
            <div class="item">
                @include('site.includes.item-room-package-detail', ['room' => $room, 'zRoom' => $room['z_room'], "date" => $date, "pk_nha_hang" => $pk_nha_hang])
            </div>
        @endif
    @endforeach
</div>



