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
                        <label for="name">{{ __("admin_table.z_teams.attr_name") }}</label>
                        <input type="text" id="name" name="name"
                               class="form-control"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="position">{{ __("admin_table.z_teams.attr_position") }}</label>
                        <input type="text" id="position" name="position"
                               class="form-control"
                               value="{{ old("position", $data->position) }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">{{ __("admin_global.attr_content") }}</label>
                        <textarea id="content" name="content"
                                  class="form-control">{{  old("content", $data->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    @include("admin.includes.image-edit-add-field", ['image' => old('image', $data->image)])
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
