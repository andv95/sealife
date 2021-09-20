@php
    $item = (!empty($item) ? $item : null);
    $key = (is_numeric(@$key) ? $key : 0);
@endphp

<div class="edit-add-append-view-item js_edit_add_append_view_item" data-key="{{ $key }}">
    <span class="edit-add-append-view-item-remove js_edit_add_append_view_item_remove">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>

    <div class="edit-add-append-view-input">
        <label>{{ __("admin_table.pages.attr_title") . " ". ($key + 1) }}</label>
        <input type="text" name="titles[{{ $key }}]" class="form-control"
               value="{{ $item }}">
    </div>
</div>
