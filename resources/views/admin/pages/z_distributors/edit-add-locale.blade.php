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


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">{{ __("admin_global.attr_phone") }}</label>
                        <input type="text" id="phone" name="phone"
                               class="form-control"
                               value="{{ old("name", $data->phone) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">{{ __("admin_global.attr_email") }}</label>
                        <input type="text" id="email" name="email"
                               class="form-control"
                               value="{{ old("name", $data->email) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ __("admin_global.attr_address") }}</label>
                        <textarea id="address" name="address"
                                  class="form-control">{{  old("address", $data->address) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


