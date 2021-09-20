@if($zRoom->hasTranslation())
    <div class="item-package-cruise item owl-number-custom " data-index-number="{{ $loop->index + 1 }}">
        <img src="{{ $zRoom->getImageUrl() }}" alt="{{ $zRoom->image['alt'] }}"
             title="{{ $zRoom->image['title'] }}">
        <div class="content-item-package-cruise">
            <h3>{{ $zRoom->name }}</h3>
            <div class='detail-item-package-cruise' style="border: none;">
                <p>{{ __('site_global.text_room_size') }}: {{ $zRoom->size }}</p>
                <p>{{ __('site_global.text_maximum_guest') }}: {{ $zRoom->max_guest_no }}</p>
            </div>
            {{--<div class="footer-item-package-cruise">
                <p>Rate from: <strong>{{ $zRoom->price }}</strong></p>
                <div class="button-public-center">
                    <a href="" title="" class="button-public">CHECK AVAIBILITY</a>
                </div>
            </div>--}}
        </div>
    </div>
@endif
