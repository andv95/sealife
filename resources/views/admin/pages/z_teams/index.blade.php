@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_teams.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.z_teams.create")])
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped js_datatable"
                   data-url="{{ route("admin.z_teams.get_table_data") }}"
                   data-cols="id,global_name,branch,active_flg,created_at,action_edit,action_delete,action_clone"
            >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __("admin_global.attr_global_name") }}</th>
                    <th>{{ __("admin_table.z_teams.attr_branch") }}</th>
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
@stop
