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

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sub_name">{{ __("admin_table.z_cruises.attr_sub_name") }}</label>
                        <input type="text" id="sub_name" name="sub_name"
                               class="form-control"
                               value="{{ old("sub_name", $data->sub_name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="long_name">{{ __("admin_table.z_cruises.attr_long_name") }}</label>
                        <input type="text" id="long_name" name="long_name"
                               class="form-control"
                               value="{{ old("long_name", $data->long_name) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="excerpt">{{ __("admin_global.attr_excerpt") }}</label>
                        <textarea id="excerpt" name="excerpt"
                                  class="form-control">{{ old("excerpt", $data->excerpt) }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    @include("admin.includes.checkbox-edit-add-flg-area",
                    [
                        'data' => $data,
                        'label' => __("admin_global.attr_excerpt_show_mobile"),
                        'field' => 'excerpt_show_mobile',
                        'defaultChecked' => false
                    ])
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ __("admin_global.attr_description") }}</label>
                        <textarea id="description" name="description"
                                  class="form-control editor">{{  old("description", $data->description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", ['image' => old('image', $data->image)])
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
