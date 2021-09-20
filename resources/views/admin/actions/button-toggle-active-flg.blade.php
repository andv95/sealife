@if($data->isActive())
    <a href="javascript:void(0);" title="{{ __("admin_global.label_active") }}">
        <span class="badge bg-success">{{ __("admin_global.label_active") }}</span>
    </a>
@else
    <a href="javascript:void(0);" title="{{ __("admin_global.label_in_active") }}">
        <span class="badge bg-danger">{{ __("admin_global.label_in_active") }}</span>
    </a>
@endif
