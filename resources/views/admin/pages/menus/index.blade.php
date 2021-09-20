@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.menus.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.menus.create")])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.menus.get_table_data") }}"
                       data-cols="id,name,active_flg,action_menu_build,action_edit,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_name") }}</th>
                        <th>{{ __("admin_global.attr_active_flg") }}</th>
                        <th>{{ __("admin_table.menus.label_drop_drag") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_edit") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
