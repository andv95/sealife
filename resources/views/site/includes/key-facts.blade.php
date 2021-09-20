<div class="list-service-cruise">
    @if($keyFacts = $data->getKeyFacts())
        @foreach($keyFacts as $item)
            <div class="list-service-item">
                <img src="{{ $item['url'] }}" alt="{{ $item['alt'] }}" title="{{ $item['title'] }}">
                <p>{{ $item['title'] }}</p>
            </div>
        @endforeach
    @endif
    <div class="clear-both"></div>
</div>
