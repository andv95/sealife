<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.pages.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.pages.update", $data->getKey()) : route("admin.pages.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="row" id="js_edit_content_on_change_language">
                    @include("admin.pages.pages.edit-add-locale", ["data" => $dataTranslation, "dataRoot" => $data])
                </div>
            </div>
            <div class="col-md-3">
                <div class="edit-add-action-wrapper">
                    @include("admin.actions.button-cancel", ["url" => route("admin.pages.index")])
                    @include("admin.actions.button-save")
                </div>

                @include("admin.includes.language-id-edit-add-area",[
                    'data' => $data,
                    "routeName" => "admin.pages.get_data_language",
                    "languages" => $languages
                ])

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __("admin_global.label_global_info") }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="global_name">{{ __("admin_global.attr_global_name") }}</label>
                                    <input type="text" id="global_name" name="global_name"
                                           class="form-control"
                                           value="{{ old("global_name", $data->global_name) }}">
                                </div>
                            </div>

                            @if(!$data->isFixedPage())
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="view_name">{{ __("admin_table.pages.attr_view_name") }}</label>
                                        <select class="form-control select2" id="view_name"
                                                name="view_name" style="width: 100%;">
                                            <option
                                                value="">{{ __("admin_table.pages.option_view_name_default") }}</option>
                                            @foreach($viewNames as $item)
                                                <option value="{{ $item }}"
                                                        @if($item == old("attr_z_post_ids", $data->view_name)) selected @endif>
                                                    {{ __("admin_table.pages.option_view_name_". $item) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(!$data->isFixedPage())
                            @include("admin.includes.active-flg-edit-add-area", ['data' => $data])
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
@stop
