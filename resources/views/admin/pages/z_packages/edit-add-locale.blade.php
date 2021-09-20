<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ __("admin_global.label_general_info") }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">{{ __("admin_global.attr_name") }}</label>
                        <input type="text" id="name" name="name"
                               class="form-control @if(!$data->getKey()) js_render_slug @endif"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slug">{{ __("admin_global.attr_slug") }}</label>
                        <input type="text" id="slug" name="slug"
                               class="form-control js_receive_slug"
                               value="{{ old("slug", $data->slug) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", ['image' => old('image', $data->image)])
                </div>

                <div class="col-md-12">
                    @include("admin.includes.multi-image-edit-add-field", [
                        'images' => old('images', $data->images),
                    ])
                </div>

                <div class="col-md-12">
                    @php
                        $itinerary = old("itinerary", $data->itinerary);
                        $itineraryList = (is_array($itinerary['list']) ? $itinerary['list'] : []);
                    @endphp
                    <div class="form-group">
                        <label>{{ __("admin_table.z_packages.attr_itinerary") }}</label>
                        <textarea name="itinerary[title]"
                                  placeholder="{{ __("admin_table.z_packages.attr_itinerary_title_plh") }}"
                                  class="form-control">{{ @$itinerary['title'] }}</textarea>

                        <div class="edit-add-append-view-wrapper js_edit_add_append_view_wrapper">
                            <div class="edit-add-append-view-list js_edit_add_append_view_list">
                                @if($itineraryList)
                                    @foreach($itineraryList as $key => $item)
                                        @include("admin.pages.z_packages.sub.itinerary-item", ["item" => $item, 'key' => $key])
                                    @endforeach
                                @else
                                    @include("admin.pages.z_packages.sub.itinerary-item")
                                @endif
                            </div>
                            <div class="edit-add-append-view-action">
                                <button data-url="{{ route("admin.z_packages.get_itinerary_view") }}" type="button"
                                        class="btn btn-primary btn-sm js_edit_add_append_view_button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", [
                        'image' => old('itinerary_bg_image', $data->itinerary_bg_image),
                        'field' => 'itinerary_bg_image',
                        'label' =>  __("admin_table.z_packages.attr_itinerary_bg_image")
                    ])
                </div>

                <div class="col-md-12">
                    @include("admin.includes.file-edit-add-field", [
                        'value' => old('itinerary_file', $data->itinerary_file),
                        'field' => 'itinerary_file',
                        'label' => 'Itinerary PDF'
                    ])
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="price_inclusion">{{ __("admin_table.z_packages.attr_price_inclusion") }}</label>
                        <textarea id="price_inclusion" name="price_inclusion"
                                  class="form-control editor">{{  old("price_inclusion", $data->price_inclusion) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="price_exclusion">{{ __("admin_table.z_packages.attr_price_exclusion") }}</label>
                        <textarea id="price_exclusion" name="price_exclusion"
                                  class="form-control editor">{{  old("price_exclusion", $data->price_exclusion) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cruise_policy">{{ __("admin_table.z_packages.attr_cruise_policy") }}</label>
                        <textarea id="cruise_policy" name="cruise_policy"
                                  class="form-control editor">{{  old("cruise_policy", $data->cruise_policy) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="booking_policy">{{ __("admin_table.z_packages.attr_booking_policy") }}</label>
                        <textarea id="booking_policy" name="booking_policy"
                                  class="form-control editor">{{  old("booking_policy", $data->booking_policy) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@include("admin.includes.seo-edit-add-area", ['data' => $data])
