<div class="item-new">
    <a href="{{ $data->getDetailUrl() }}" title="{{ $data->name }}">
        <img src="{{ @$data->getImageUrl(!empty($large)) }}" alt="{{ @$data->image["alt"] }}"
             title="{{ @$data->image["title"] }}">
    </a>

    <div class="item-new-content">
        @if(($zNewsType = $data->getZNewsType()) && $zNewsType->hasTranslation())
            <a class="tip" href="{{ $zNewsType->getDetailUrl() }}"
               title="{{ $zNewsType->name }}">{{ $zNewsType->name }}</a>
        @endif

        <h3>
            <a href="{{ $data->getDetailUrl() }}" title="{{ $data->name }}">
                {{ $data->name }}
            </a>
        </h3>

        @if(empty($noContent))
            <div class="excerpt-new">
                {{ $data->excerpt }}
            </div>
            <a class="read-more-public" href="{{ $data->getDetailUrl() }}" title="{{ $data->name }}">READ MORE</a>
        @endif
    </div>
</div>
