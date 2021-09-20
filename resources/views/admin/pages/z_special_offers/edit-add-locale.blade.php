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
                               class="form-control"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_desc">{{ __("admin_table.z_special_offers.attr_short_desc") }}</label>
                        <textarea id="short_desc" name="short_desc"
                                  class="form-control">{{ old("short_desc", $data->short_desc) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="invalid_desc">{{ __("admin_table.z_special_offers.attr_invalid_desc") }}</label>
                        <textarea id="invalid_desc" name="invalid_desc"
                                  class="form-control">{{ old("invalid_desc", $data->invalid_desc) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

