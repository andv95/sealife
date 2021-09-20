<li class="dd-item" data-id="{{ $menuItem->getKey() }}">
    <div class="dd-handle">
        <div class="inline">
            {{ $menuItem->global_name }}
        </div>

        <div class="float-right">
            <a href="{{ route("admin.menu_items.edit", $menuItem->getKey()) }}" class="dd-nodrag">
                <i class="fa fa-pencil fa-fw"></i> {{ __("admin_global.label_edit") }}
            </a>
            <a href="{{ route("admin.menu_items.destroy", ["ids" => $menuItem->getKey()]) }}"
               onclick="return confirm('{{ __("admin_global.message_confirm_destroy") }}')"
               class="text-danger dd-nodrag">
                <i class="fa fa-trash-o fa-fw"></i> {{ __("admin_global.label_destroy") }}
            </a>
        </div>
    </div>

    {!! $childrenLayout !!}
</li>
