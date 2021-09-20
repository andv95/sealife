<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.users.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.users.update", $data->getKey()) : route("admin.users.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.users.index")])
            @include("admin.actions.button-save")
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
                        <div class="form-group">
                            <label for="name">{{ __("admin_global.attr_name") }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ old("name", $data->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __("admin_table.users.attr_email") }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ old("email", $data->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __("admin_table.users.attr_password") }}</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
@stop
