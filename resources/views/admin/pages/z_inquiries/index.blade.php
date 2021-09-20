@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_inquiries.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_inquiries.get_table_data") }}"
                       data-cols="id,name,email,start_date,z_package_id,z_room_id,number_of_room,promotion_price,created_at,action_show,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_name") }}</th>
                        <th>{{ __("admin_global.attr_email") }}</th>
                        <th>{{ __("admin_table.z_inquiries.attr_start_date") }}</th>
                        <th>{{ __("admin_table.z_inquiries.attr_z_package_id") }}</th>
                        <th>{{ __("admin_table.z_inquiries.attr_z_room_id") }}</th>
                        <th>{{ __("admin_table.z_inquiries.attr_number_of_room") }}</th>
                        <th>{{ __("admin_table.z_inquiries.attr_promotion_price") }}</th>
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
