@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_show")." " . __("admin_table.z_contacts.label_title"))

@section("mainContent")
    <div class="edit-add-action-wrapper">
        @include("admin.actions.button-cancel", ["url" => route("admin.z_contacts.index")])
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __("admin_global.label_general_info") }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __("admin_global.attr_name") }}</label>
                                        <p id="name">
                                            {{ $data->getFullName() }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="email">{{ __("admin_global.attr_email") }}</label>
                                        <p id="email">
                                            {{ $data->email }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="phone">{{ __("admin_global.attr_phone") }}</label>
                                        <p id="phone">
                                            {{ $data->phone }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="looking_for">{{ __("admin_table.z_contacts.attr_looking_for") }}</label>
                                        <p id="looking_for">
                                            {{ $data->looking_for }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="interested_in">{{ __("admin_table.z_contacts.attr_interested_in") }}</label>
                                        <p id="interested_in">
                                            {{ $data->interested_in }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="something_else">{{ __("admin_table.z_contacts.attr_something_else") }}</label>
                                        <p id="something_else">
                                            {{ $data->something_else }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
