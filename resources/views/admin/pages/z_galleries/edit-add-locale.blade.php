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
                <div class="col-md-12">
                    @include("admin.includes.multi-image-edit-add-field", [
                        'images' => old('images', $data->images),
                        'params' => ['video_url' => true]
                    ])
                </div>

                <div class="col-md-12">
                    @include("admin.includes.multi-image-edit-add-field", [
                        'label' => __("admin_global.attr_images_mobile"),
                        'field' => 'images_mobile',
                        'images' => old('images_mobile', $data->images_mobile),
                        'params' => ['video_url' => true]
                    ])
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

