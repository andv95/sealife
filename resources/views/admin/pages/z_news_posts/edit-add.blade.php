<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.z_news_posts.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.z_news_posts.update", $data->getKey()) : route("admin.z_news_posts.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="row" id="js_edit_content_on_change_language">
                    @include("admin.pages.z_news_posts.edit-add-locale", ["data" => $dataTranslation])
                </div>
            </div>
            <div class="col-md-3">
                <div class="edit-add-action-wrapper">
                    @include("admin.actions.button-cancel", ["url" => route("admin.z_news_posts.index")])
                    @include("admin.actions.button-save")
                </div>

                @include("admin.includes.language-id-edit-add-area",[
                    'data' => $data,
                    "routeName" => "admin.z_news_posts.get_data_language",
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
                                        for="z_news_type_ids">{{ __("admin_table.z_news_posts.attr_z_news_type_ids") }}</label>
                                    <select class="form-control select2" id="z_news_type_ids" name="z_news_type_ids[]"
                                            multiple
                                            style="width: 100%;">
                                        @foreach($zNewsTypes as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("z_news_type_ids", $data->zNewsTypes->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_package_ids">{{ __("admin_table.z_news_posts.attr_z_package_ids") }}</label>
                                    <select class="form-control select2" id="z_package_ids" name="z_package_ids[]"
                                            multiple
                                            style="width: 100%;">
                                        @foreach($zPackages as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("z_package_ids", $data->zPackages->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @include("admin.includes.checkbox-edit-add-flg-area",
                                [
                                    'data' => $data,
                                    'label' => __("admin_table.z_news_posts.attr_featured1_flg"),
                                    'field' => 'featured1_flg',
                                    'defaultChecked' => false
                                ])
                            </div>

                            <div class="col-md-6">
                                @include("admin.includes.checkbox-edit-add-flg-area",
                                [
                                    'data' => $data,
                                    'label' => __("admin_table.z_news_posts.attr_featured2_flg"),
                                    'field' => 'featured2_flg',
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
