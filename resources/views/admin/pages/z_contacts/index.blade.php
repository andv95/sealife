@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_contacts.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_contacts.get_table_data") }}"
                       data-cols="id,full_name,email,phone,created_at,action_show,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_name") }}</th>
                        <th>{{ __("admin_global.attr_email") }}</th>
                        <th>{{ __("admin_global.attr_phone") }}</th>
                        <th>{{ __("admin_global.attr_created_at") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_show") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
