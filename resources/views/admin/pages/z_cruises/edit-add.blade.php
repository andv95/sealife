<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.z_cruises.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.z_cruises.update", $data->getKey()) : route("admin.z_cruises.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="row" id="js_edit_content_on_change_language">
                    @include("admin.pages.z_cruises.edit-add-locale", ["data" => $dataTranslation])
                </div>
            </div>
            <div class="col-md-3">
                <div class="edit-add-action-wrapper">
                    @include("admin.actions.button-cancel", ["url" => route("admin.z_cruises.index")])
                    @include("admin.actions.button-save")
                </div>

                @include("admin.includes.language-id-edit-add-area",[
                    'data' => $data,
                    "routeName" => "admin.z_cruises.get_data_language",
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
                                    <label
                                        for="z_property_id">{{ __("admin_table.z_cruises.attr_z_property_id") }}</label>
                                    <select class="form-control select2" id="z_property_id" name="z_property_id"
                                            style="width: 100%;">
                                        @foreach($zProperties as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if($item->getKey() == old("z_property_id", $data->z_property_id)) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_post_ids">{{ __("admin_table.z_cruises.attr_z_post_ids") }}</label>
                                    <select class="form-control select2" id="z_post_ids"
                                            name="z_post_ids[]" multiple
                                            style="width: 100%;">
                                        @foreach($zPosts as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("attr_z_post_ids", $data->zPosts->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @include("admin.includes.checkbox-edit-add-flg-area",
                                [
                                    'data' => $data,
                                    'label' => __("admin_global.attr_home_flg"),
                                    'field' => 'home_flg',
                                    'defaultChecked' => false
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
