<div class="item-package-cruise-detail ">
    <img src="{{ $zRoom->getImageUrl() }}" alt="{{ $zRoom->image['alt'] }}"
         title="{{ $zRoom->image['title'] }}">
    <div class="content-item-package-cruise">
        <h3>{{ $zRoom->name }}</h3>
        <div class='detail-item-package-cruise'>
            <p>{{ __('site_global.text_room_size') }}: {{ $zRoom->size }}</p>
            <p>{{ __('site_global.text_maximum_guest') }}: {{ $zRoom->max_guest_no }}</p>
        </div>
        <div class="footer-item-package-cruise">
            {{--<p>From <strong>{{ $zRoom->price }}</strong></p>--}}
        </div>
    </div>
</div>
