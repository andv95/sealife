<p class="@if($loop->odd) cruise-checked @else cruise-coupon @endif">
    <img loading="lazy" src="{{ @$item->image["url"] }}" alt="{{ @$item->image["alt"] ?: basename($item->image["url"]) }}"
         title="{{ @$item->image["title"] }}" width="24" height="24">
    {{ $item->name }}
</p>
