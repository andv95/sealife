@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.settings.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.settings.create")])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.settings.get_table_data") }}"
                       data-cols="id,display_name,key,type,group,language_flg,order_no,action_edit,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_table.settings.attr_display_name") }}</th>
                        <th>{{ __("admin_table.settings.attr_key") }}</th>
                        <th>{{ __("admin_table.settings.attr_type") }}</th>
                        <th>{{ __("admin_table.settings.attr_group") }}</th>
                        <th>{{ __("admin_table.settings.attr_language_flg") }}</th>
                        <th>{{ __("admin_table.settings.attr_order_no") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_edit") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
