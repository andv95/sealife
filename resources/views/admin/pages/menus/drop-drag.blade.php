@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.menus.label_drop_drag"). " " . __("admin_table.menus.label_title"))

@section("css")
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/nestable/nestable.css') }}">

    <style>
        .dd {
            max-width: none;
        }

        .dd-handle {
            margin: 8px 0;
            padding: 10px;
            height: auto;
        }

        .dd-item > button {
            margin-top: 10px;
        }

        .menu-drop-drag-wrapper .inline {
            display: inline;
        }
    </style>
@stop

@section("mainContent")
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                {{ __("admin_table.menus.label_drop_drag_to_re_order") }}: <strong>{{ $menu->name }}</strong>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="edit-add-action-wrapper">
                @include("admin.actions.button-create", ["url" => route("admin.menu_items.create", ["menu_id" => $menu->getKey()])])
            </div>

            <div class="menu-drop-drag-wrapper" style="margin-top: 50px;">
                <div class="dd" id="sort_menu"
                     data-url="{{ route("admin.menus.sort_after_drop_drag", $menu->getKey()) }}">
                    {!! menu($menu, [
                        'item_view' => "admin.pages.menus.nestable-menu-item",
                        'start_tag' => '<ol class="dd-list">',
                        'end_tag' => '</ol>'
                    ]) !!}
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section("js")
    <script src="{{ asset('admin_assets/plugins/nestable/nestable.js') }}"></script>

    <script>
        $(document).ready(function () {
            prjSystems.nestable.sortMenuItem();
        });
    </script>
@stop
