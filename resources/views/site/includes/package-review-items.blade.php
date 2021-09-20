@foreach($zReviews as $item)
    @if($item->hasTranslation())
        <div class="trip-detail">
            <img src="{{ @$item->image['url'] }}" alt="{{ @$item->image['alt'] }}"
                 title="{{ @$item->image['title'] }}">
            <div class="trip-detail-content">
                <h3>{{ $item->name }}</h3>
                <span>{{ $item->created_at->diffForHumans() }}</span>
                <div class="trip-detail-content-scroll">{!! $item->content !!}</div>
            </div>
            <i class="fas fa-camera camera-trip"></i>
            <div class="clear-both"></div>
        </div>
    @endif
@endforeach
