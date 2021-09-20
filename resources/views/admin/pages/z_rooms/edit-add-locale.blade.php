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
                               class="form-control {{--@if(!$data->getKey()) js_render_slug @endif--}}"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>

                {{--<div class="col-md-6">
                    <div class="form-group">
                        <label for="slug">{{ __("admin_global.attr_slug") }}</label>
                        <input type="text" id="slug" name="slug"
                               class="form-control js_receive_slug"
                               value="{{ old("slug", $data->slug) }}">
                    </div>
                </div>--}}

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="size">{{ __("admin_table.z_rooms.attr_size") }}</label>
                        <input type="text" id="size" name="size"
                               class="form-control"
                               value="{{ old("size", $data->size) }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="price">{{ __("admin_global.attr_price") }}</label>
                        <input type="text" id="price" name="price"
                               class="form-control"
                               value="{{ old("price", $data->price) }}">
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
                    @include("admin.includes.multi-image-edit-add-field", [
                        'label' => __("admin_global.attr_key_facts"),
                        'field' => 'key_facts',
                        'images' => old('key_facts', $data->key_facts),
                    ])
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@include("admin.includes.seo-edit-add-area", ['data' => $data])
