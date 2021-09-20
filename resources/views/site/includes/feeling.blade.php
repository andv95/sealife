<section class="high-light high-light-feeling">
    <h2 class="head-high-light">{!! setting('site_home.gallery_head') !!}</h2>
    <div class="gallery-feeling">
        <div class="wrapper-gallery-feeling-public">
            <div class="gallery-feeling-public gallery-feeling1">
                <a href="{{ $images[1]->url }}" title="{{ $images[1]->caption }}">
                    <img src="{{ $images[1]->url }}" alt="{{ $images[1]->alt }}" title="{{ $images[1]->caption }}">
                    <span class="feeling-caption">{{ $images[1]->caption }}</span>
                </a>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <a href="{{ $images[2]->url }}" title="{{ $images[2]->caption }}">
                            <img src="{{ $images[2]->url }}" alt="{{ $images[2]->alt }}"
                                 title="{{ $images[2]->caption }}">
                            <span class="feeling-caption">{{ $images[1]->caption }}</span>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <a href="{{ $images[3]->url }}" title="{{ $images[3]->caption }}">
                            <img src="{{ $images[3]->url }}" alt="{{ $images[3]->alt }}"
                                 title="{{ $images[3]->caption }}">
                            <span class="feeling-caption">{{ $images[1]->caption }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="gallery-feeling-private gallery-feeling2">
                <a href="{{ $images[4]->url }}" title="{{ $images[4]->caption }}">
                    <img src="{{ $images[4]->url }}" alt="{{ $images[4]->alt }}" title="{{ $images[4]->caption }}">
                    <span class="feeling-caption">{{ $images[1]->caption }}</span>
                </a>
            </div>
            <div class="gallery-feeling-public gallery-feeling3">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <a href="{{ $images[5]->url }}" title="{{ $images[5]->caption }}">
                            <img src="{{ $images[5]->url }}" alt="{{ $images[5]->alt }}"
                                 title="{{ $images[5]->caption }}">
                            <span class="feeling-caption">{{ $images[1]->caption }}</span>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <a href="{{ $images[6]->url }}" title="{{ $images[6]->caption }}">
                            <img src="{{ $images[6]->url }}" alt="{{ $images[6]->alt }}"
                                 title="{{ $images[6]->caption }}">
                            <span class="feeling-caption">{{ $images[1]->caption }}</span>
                        </a>
                    </div>
                </div>
                <a href="{{ $images[7]->url }}" title="{{ $images[7]->caption }}">
                    <img src="{{ $images[7]->url }}" alt="{{ $images[7]->alt }}" title="{{ $images[7]->caption }}">
                    <span class="feeling-caption">{{ $images[1]->caption }}</span>
                </a>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
</section>
