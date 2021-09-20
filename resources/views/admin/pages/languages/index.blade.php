@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.languages.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.languages.create")])
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.languages.get_table_data") }}"
                       data-cols="id,language_key,native_name,order_no,remark,action_edit,action_delete"
                       data-order-by="0,asc"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_table.languages.attr_language_key") }}</th>
                        <th>{{ __("admin_table.languages.attr_native_name") }}</th>
                        <th>{{ __("admin_table.languages.attr_order_no") }}</th>
                        <th>{{ __("admin_global.attr_remark") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_edit") }}</th>
                        <th class="text-center">{{ __("admin_global.label_action_delete") }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
