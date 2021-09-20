@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.z_news_posts.label_title"))

@section("mainContent")
    <div class="card">
        <div class="card-header">
            @include("admin.actions.button-create", ["url" => route("admin.z_news_posts.create")])
        </div>

        <div class="card-body">
            <div class="index-filter-wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" class="form-control select2">
                                <option value="">---All---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->global_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped js_datatable"
                       data-url="{{ route("admin.z_news_posts.get_table_data") }}"
                       data-cols="id,global_name,featured1_flg,featured2_flg,active_flg,created_at,action_edit,action_delete,action_clone"
                       data-filter-ids="category_id"
                >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __("admin_global.attr_global_name") }}</th>
                        <th>{{ __("admin_table.z_news_posts.attr_featured1_flg") }}</th>
                        <th>{{ __("admin_table.z_news_posts.attr_featured2_flg") }}</th>
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
