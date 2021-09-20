<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.z_rooms.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.z_rooms.update", $data->getKey()) : route("admin.z_rooms.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="row" id="js_edit_content_on_change_language">
                    @include("admin.pages.z_rooms.edit-add-locale", ["data" => $dataTranslation])
                </div>
            </div>
            <div class="col-md-3">
                <div class="edit-add-action-wrapper">
                    @include("admin.actions.button-cancel", ["url" => route("admin.z_rooms.index")])
                    @include("admin.actions.button-save")
                </div>

                @include("admin.includes.language-id-edit-add-area",[
                    'data' => $data,
                    "routeName" => "admin.z_rooms.get_data_language",
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

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="max_guest_no">{{ __("admin_table.z_rooms.attr_max_guest_no") }}</label>
                                    <input type="text" id="max_guest_no" name="max_guest_no"
                                           class="form-control"
                                           value="{{ old("max_guest_no", $data->max_guest_no) }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_cruise_id">{{ __("admin_table.z_rooms.attr_z_cruise_id") }}</label>
                                    <select class="form-control select2" id="z_cruise_id" name="z_cruise_id"
                                            style="width: 100%;">
                                        @foreach($zCruises as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if($item->getKey() == old("z_cruise_id", $data->z_cruise_id)) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @include("admin.includes.api-id-edit-add-field", [
                                    "apiIds" => $apiIds,
                                    "data" => $data
                                ])
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
