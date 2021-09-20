@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_newsletters.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_newsletters.get_table_data") }}"
                       data-cols="id,mail_address,created_at,action_delete"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_mail_address") }}</th>
                        <th>{{ __("admin_global.attr_created_at") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
