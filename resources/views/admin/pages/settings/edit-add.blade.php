<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.settings.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.settings.update", $data->getKey()) : route("admin.settings.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.settings.index")])
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
                                    <label for="key">{{ __("admin_table.settings.attr_key") }}</label>
                                    <input type="text" id="key" name="key" class="form-control"
                                           value="{{ old("key", $data->key) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="display_name">{{ __("admin_table.settings.attr_display_name") }}</label>
                                    <input type="text" id="display_name" name="display_name" class="form-control"
                                           value="{{ old("display_name", $data->display_name) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">{{ __("admin_table.settings.attr_type") }}</label>
                                    <select class="form-control select2" id="type" name="type" style="width: 100%;">
                                        @foreach($settingTypes as $item)
                                            <option value="{{ $item }}"
                                                    @if($item === (int)old("type", $data->type)) selected @endif>
                                                {{ __("admin_table.settings.option_type_". $item) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group">{{ __("admin_table.settings.attr_group") }}</label>
                                    <select class="form-control select2" id="group" name="group" style="width: 100%;">
                                        @foreach($settingGroups as $item)
                                            <option value="{{ $item }}"
                                                    @if($item === old("group", $data->group)) selected @endif>
                                                {{ __("admin_table.settings.option_group_". $item) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="order_no">{{ __("admin_table.settings.attr_order_no") }}</label>
                                    <input type="number" id="order_no" name="order_no" min="0" class="form-control"
                                           value="{{ old("order_no", $data->order_no) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                @include("admin.includes.checkbox-edit-add-flg-area", [
                                    'field' => 'language_flg',
                                    'label' => __("admin_table.settings.attr_language_flg"),
                                    'data' => $data,
                                    'defaultChecked' => false
                                ])
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </form>
@stop
