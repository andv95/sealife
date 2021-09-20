<div class="callout callout-{{ !empty($type) ? $type : "danger" }}">
    @if(!empty($messageTitle))
        <h5>{{ $messageTitle }}</h5>
    @endif

    @if(is_array($messages))
        @foreach($messages as $item)
            <p class="text-{{ !empty($type) ? $type : "danger" }} mb-0">{{ $item }}</p>
        @endforeach
    @else
        <p class="text-{{ !empty($type) ? $type : "danger" }} mb-0">{{ $messages }}</p>
    @endif
</div>
