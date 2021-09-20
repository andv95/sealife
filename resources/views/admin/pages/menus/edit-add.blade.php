<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.menus.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.menus.update", $data->getKey()) : route("admin.menus.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.menus.index")])
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __("admin_global.attr_name") }}</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           value="{{ old("name", $data->name) }}">
                                </div>
                            </div>
                        </div>

                        @include("admin.includes.active-flg-edit-add-area", ['data' => $data])
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
@stop
