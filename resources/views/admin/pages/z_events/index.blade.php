@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_events.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_events.get_table_data") }}"
                       data-cols="id,service,email,group_size,event_detail,created_at,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_table.z_events.attr_service") }}</th>
                        <th>{{ __("admin_global.attr_email") }}</th>
                        <th>{{ __("admin_table.z_events.attr_group_size") }}</th>
                        <th>{{ __("admin_table.z_events.attr_event_detail") }}</th>
                        <th>{{ __("admin_global.attr_created_at") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
