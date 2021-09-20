@foreach($zNewsPosts as $item)
    @if($item->hasTranslation())
        <div class="col-md-4">
            @include('site.includes.news-post-item', ["data" => $item, 'large' => true])
        </div>
    @endif
@endforeach
