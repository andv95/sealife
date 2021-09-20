<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.z_packages.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.z_packages.update", $data->getKey()) : route("admin.z_packages.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="row" id="js_edit_content_on_change_language">
                    @include("admin.pages.z_packages.edit-add-locale", ["data" => $dataTranslation])
                </div>
            </div>
            <div class="col-md-3">
                <div class="edit-add-action-wrapper">
                    @include("admin.actions.button-cancel", ["url" => route("admin.z_packages.index")])
                    @include("admin.actions.button-save")
                </div>

                @include("admin.includes.language-id-edit-add-area",[
                    'data' => $data,
                    "routeName" => "admin.z_packages.get_data_language",
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
                                        for="z_cruise_id">{{ __("admin_table.z_packages.attr_z_cruise_id") }}</label>
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
                                <div class="form-group">
                                    <label
                                        for="z_duration_id">{{ __("admin_table.z_packages.attr_z_duration_id") }}</label>
                                    <select class="form-control select2" id="z_duration_id" name="z_duration_id"
                                            style="width: 100%;">
                                        @foreach($zDurations as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if($item->getKey() == old("z_duration_id", $data->z_duration_id)) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_offer_ids">{{ __("admin_table.z_packages.attr_z_offer_ids") }}</label>
                                    <select class="form-control select2" id="z_offer_ids" name="z_offer_ids[]" multiple
                                            style="width: 100%;">
                                        @foreach($zOffers as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("z_offer_ids", $data->zOffers->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_special_offer_ids">{{ __("admin_table.z_packages.attr_z_special_offer_ids") }}</label>
                                    <select class="form-control select2" id="z_special_offer_ids"
                                            name="z_special_offer_ids[]" multiple
                                            style="width: 100%;">
                                        @foreach($zSpecialOffers as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("z_special_offer_ids", $data->zSpecialOffers->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_destination_ids">{{ __("admin_table.z_packages.attr_z_destination_ids") }}</label>
                                    <select class="form-control select2" id="z_destination_ids"
                                            name="z_destination_ids[]" multiple
                                            style="width: 100%;">
                                        @foreach($zDestinations as $item)
                                            <option value="{{ $item->getKey() }}"
                                                    @if(in_array($item->getKey(), old("z_destination_ids", $data->zDestinations->pluck("id")->toArray()))) selected @endif>
                                                {{ $item->global_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        for="z_post_ids">{{ __("admin_table.z_packages.attr_z_post_ids") }}</label>
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
                                <div class="form-group">
                                    <label for="order_no">{{ __("admin_global.attr_order_no") }}</label>
                                    <input type="number" min="0" id="order_no" name="order_no"
                                           class="form-control"
                                           value="{{ old("order_no", $data->order_no) }}">
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
