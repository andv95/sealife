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
                        'params' => ["link" => true]
                    ])
                </div>
                <div class="col-md-12">
                    @include("admin.includes.multi-image-edit-add-field", [
                        'field' => 'images_mobile',
                        'label' => __("admin_table.z_banners.attr_images_mobile"),
                        'images' => old('images_mobile', $data->images_mobile),
                        'params' => ["link" => true]
                    ])
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="video_url">{{ __("admin_table.z_banners.attr_video_url") }}</label>
                        <input type="text" id="video_url" name="video_url"
                               class="form-control"
                               value="{{ old("video_url", $data->video_url) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="video_url_mobile">{{ __("admin_table.z_banners.attr_video_url_mobile") }}</label>
                        <input type="text" id="video_url_mobile" name="video_url_mobile"
                               class="form-control"
                               value="{{ old("video_url_mobile", $data->video_url_mobile) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="view_more_url">{{ __("admin_table.z_banners.attr_view_more_url") }}</label>
                        <input type="text" id="view_more_url" name="view_more_url"
                               class="form-control"
                               value="{{ old("view_more_url", $data->view_more_url) }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


