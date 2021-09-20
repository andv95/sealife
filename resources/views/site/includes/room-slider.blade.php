<div
    class="main-content owl-custom-button owl-custom-button-remove owl-package owl-mobile-number head-slide-package-room row d-flex justify-content-center">
    @foreach($rooms as $room)
        @if($room['z_room']->hasTranslation())
            <div class="item owl-number-custom col-md-3  item-package-cruise {{ $loop->first ? 'current' : '' }}"
                 data-index-number="{{ $loop->index + 1 }}">
                @include('site.includes.item-room-package', ['zRoom' => $room['z_room']])
            </div>
        @endif
    @endforeach
</div>
<div id="sync1" class="owl-carousel owl-theme">
    @foreach($rooms as $room)
        @if($room['z_room']->hasTranslation())
            <div class="item">
                @include('site.includes.item-room-package-detail', ['room' => $room, 'zRoom' => $room['z_room'], "date" => $date, 'pk_nha_hang' => $pk_nha_hang])
            </div>
        @endif
    @endforeach
</div>



