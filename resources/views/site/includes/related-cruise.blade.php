@if(!empty($zPackages))
    <section class="list-special-offer-item">
        <div class="container">
            <div class="row">
                @foreach($zPackages as $item)
                    @if($item->hasTranslation())
                        <div class="col-md-6 news-detail-package">
                            @include("site.includes.offer-package-item")
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endif
