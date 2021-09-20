@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_packages.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.z_packages.create")])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_packages.get_table_data") }}"
                       data-cols="id,global_name,z_cruise_id,z_duration_id,order_no,active_flg,created_at,action_edit,action_delete,action_clone"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_global_name") }}</th>
                        <th>{{ __("admin_table.z_packages.attr_z_cruise_id") }}</th>
                        <th>{{ __("admin_table.z_packages.attr_z_duration_id") }}</th>
                        <th>{{ __("admin_global.attr_order_no") }}</th>
                        <th>{{ __("admin_global.attr_active_flg") }}</th>
                        <th>{{ __("admin_global.attr_created_at") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_edit") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_clone") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
