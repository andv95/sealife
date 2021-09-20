<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.z_ins_photos.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.z_ins_photos.update", $data->getKey()) : route("admin.z_ins_photos.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.z_ins_photos.index")])
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="url">{{ __("admin_table.z_ins_photos.attr_url") }}</label>
                                    <div class="edit-add-exist-image">
                                        <img src="{{ $data->url }}" alt="image" id="url">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="tag">{{ __("admin_table.z_ins_photos.attr_tag") }}</label>
                                            <p id="tag">
                                                {{ $data->tag }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="alt">{{ __("admin_table.z_ins_photos.attr_alt") }}</label>
                                            <p id="alt">
                                                {{ $data->alt }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label
                                                for="caption">{{ __("admin_table.z_ins_photos.attr_caption") }}</label>
                                            <p id="caption">
                                                {{ $data->caption }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label
                                            for="position_no">{{ __("admin_table.z_ins_photos.attr_position_no") }}</label>
                                        <select class="form-control select2" id="position_no" name="position_no"
                                                style="width: 100%;">
                                            @foreach($positions as $item)
                                                <option value=""></option>
                                                <option value="{{ $item }}"
                                                        @if($item == old("position_no", $data->position_no)) selected @endif>
                                                    {{ __("admin_table.z_ins_photos.option_position_no", ['no' => $item]) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        @include("admin.includes.active-flg-edit-add-area", ['data' => $data])
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
    </form>
@stop
