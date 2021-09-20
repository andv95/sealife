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
                    <div class="form-group">
                        <label for="excerpt">{{ __("admin_global.attr_excerpt") }}</label>
                        <textarea id="excerpt" name="excerpt"
                                  class="form-control">{{ old("excerpt", $data->excerpt) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">{{ __("admin_table.z_news_posts.attr_content") }}</label>
                        <textarea id="content" name="content"
                                  class="form-control editor">{{  old("content", $data->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", [
                        'image' => old('featured1_image', $data->featured1_image),
                        'field' => 'featured1_image',
                        'label' => __("admin_table.z_news_posts.attr_featured1_image")
                    ])
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", [
                        'image' => old('featured2_image', $data->featured2_image),
                        'field' => 'featured2_image',
                        'label' => __("admin_table.z_news_posts.attr_featured2_image")
                    ])
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@include("admin.includes.seo-edit-add-area", ['data' => $data])
