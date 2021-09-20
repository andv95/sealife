<div class="col-md-{{ !empty($grid) ? $grid : 12 }}">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ __("admin_global.label_seo_info") }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="meta_title">{{ __("admin_global.attr_meta_title") }}</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control"
                       value="{{ old("meta_title", $data->meta_title) }}">
            </div>

            <div class="form-group">
                <label for="meta_keywords">{{ __("admin_global.attr_meta_keywords") }}</label>
                <input type="text" id="meta_keywords" name="meta_keywords"
                       class="form-control"
                       value="{{ old("meta_keywords", $data->meta_keywords) }}">
            </div>

            <div class="form-group">
                <label for="meta_description">{{ __("admin_global.attr_meta_description") }}</label>
                <textarea id="meta_description" name="meta_description"
                          class="form-control">{{ old("meta_description", $data->meta_description) }}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
