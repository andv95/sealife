@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_ins_photos.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route("admin.z_ins_photos.store") }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="inputEmail3"
                                           class="col-sm-2 col-form-label">{{ __("admin_table.z_ins_photos.attr_tag") }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required id="tag"
                                               placeholder="{{ __("admin_table.z_ins_photos.label_example_tag") }}"
                                               name="tag"
                                               value="{{ old("tag") }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit"
                                        class="btn btn-success">{{ __("admin_table.z_ins_photos.btn_get_image_from_ins") }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div style="margin-bottom: 10px; text-align: right">
                        <a href="{{ route("admin.ig.get_user_media") }}" class="btn btn-primary"
                           style="display: inline-block">{{ __("admin_table.z_ins_photos.btn_get_image_from_ins_by_auth") }}</a>

                        <a href="{{ route("admin.ig.auth") }}" class="btn btn-primary"
                           style="display: inline-block">{{ __("admin_table.z_ins_photos.btn_get_access_token") }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_ins_photos.get_table_data") }}"
                       data-cols="id,ig_media_id,url,tag,position_no,active_flg,action_edit,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo ID</th>
                        <th>{{ __("admin_table.z_ins_photos.attr_url") }}</th>
                        <th>{{ __("admin_table.z_ins_photos.attr_tag") }}</th>
                        <th>{{ __("admin_table.z_ins_photos.attr_position_no") }}</th>
                        <th>{{ __("admin_global.attr_active_flg") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_edit") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
