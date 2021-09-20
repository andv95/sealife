@php
    $item = (!empty($item) ? $item : null);
    $key = (is_numeric(@$key) ? $key : 0);
@endphp

<div class="edit-add-append-view-item js_edit_add_append_view_item" data-key="{{ $key }}">
    <span class="edit-add-append-view-item-remove js_edit_add_append_view_item_remove">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>

    <div class="edit-add-append-view-input">
        <label>{{ __("admin_table.pages.attr_content") . " ". ($key + 1) }}</label>
        <textarea id="contents{{ $key }}" name="contents[{{ $key }}]"
                  class="form-control editor">{{ $item }}</textarea>
    </div>
</div>
