<div class="wrapper-rating"
     data-token="{{ csrf_token() }}"
     data-route="{{ route('site.ajax.rating') }}"
     data-id="{{ $data->id }}"
     data-type="blog"
     data-locale="{{ curLocale() }}"
     data-width="{{ $rates['avg'] ? $rates['avg']/5*100 : '0' }}">
    <div class="start-items">

    </div>
    <div>
        {{ $rates['avg'] }} / 5 (<b>{{ $rates['count'] }}</b> {{ __('site_global.rate.binh_chon') }})
    </div>
</div>
