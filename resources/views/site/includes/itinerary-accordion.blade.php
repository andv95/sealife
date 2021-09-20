<!--Accordion wrapper-->
<div class="my-accordion my-accordion-arrow">
    <div class="accordion md-accordion" id="accordionItinerary" role="tablist"
         aria-multiselectable="true">
        @foreach($itineraries["list"] as $key => $item)
            <div class="card">
                <div class="card-header" role="tab" id="itinerary_heading_{{ $key }}">
                    <a data-toggle="collapse" data-parent="#accordionItinerary"
                       href="#itinerary_collapse_{{ $key }}"
                       @if($loop->first) aria-expanded="true" @endif
                       aria-controls="itinerary_collapse_{{ $key }}">
                        <h5 class="mb-0">
                            {{ $item["title"] }} <span
                                class="plus-acc arrow-acc">{{ $loop->first ? "❯" : "❮" }}</span>
                        </h5>
                    </a>
                </div>
                <div id="itinerary_collapse_{{ $key }}"
                     class="collapse @if($loop->first) show @endif" role="tabpanel"
                     aria-labelledby="itinerary_heading_{{ $key }}"
                     data-parent="#accordionItinerary">
                    <div class="card-body">
                        {!! $item["desc"] !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Accordion wrapper -->
