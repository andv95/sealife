<div class="owl-carousel slider-1 owl-theme itinerary-slide">
    @foreach($itineraries["list"] as $key => $item)
        <div class="item">
            <h2 class="itinerary-title">{{ $item["title"] }}</h2>
            <div class="itinerary-content">
                {!! $item["desc"] !!}
            </div>
        </div>
    @endforeach
</div>
