<?php
$editFlg = !empty($data->getKey());
?>

@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_". ($editFlg ? "edit" : "create")). " " . __("admin_table.languages.label_title"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ $editFlg ? route("admin.languages.update", $data->getKey()) : route("admin.languages.store") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.languages.index")])
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
                                    <label
                                        for="language_key">{{ __("admin_table.languages.attr_language_key") }}</label>
                                    <select class="form-control select2" id="language_key" name="language_key"
                                            style="width: 100%;">
                                        @foreach($supportedLanguages as $languageKey => $item)
                                            <option value="{{ $languageKey }}"
                                                    @if($languageKey === old("language_key", $data->language_key)) selected @endif>
                                                {{ $languageKey . ' - '. $item['native'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="native_name">{{ __("admin_table.languages.attr_native_name") }}</label>
                                    <input type="text" id="native_name" name="native_name" class="form-control"
                                           value="{{ old("native_name", $data->native_name) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latin_name">{{ __("admin_table.languages.attr_latin_name") }}</label>
                                    <input type="text" id="latin_name" name="latin_name" class="form-control"
                                           value="{{ old("latin_name", $data->latin_name) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="script">{{ __("admin_table.languages.attr_script") }}</label>
                                    <input type="text" id="script" name="script" class="form-control"
                                           value="{{ old("script", $data->script) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="regional">{{ __("admin_table.languages.attr_regional") }}</label>
                                    <input type="text" id="regional" name="regional" class="form-control"
                                           value="{{ old("regional", $data->regional) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_no">{{ __("admin_table.languages.attr_order_no") }}</label>
                                    <input type="number" id="order_no" name="order_no" min="0" class="form-control"
                                           value="{{ old("order_no", $data->order_no) }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark">{{ __("admin_global.attr_remark") }}</label>
                                    <textarea id="remark" name="remark"
                                              class="form-control">{{ old("remark", $data->remark) }}</textarea>
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
