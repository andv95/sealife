@php
    $item = (!empty($item) ? $item : []);
    $key = (is_numeric(@$key) ? $key : 0);
@endphp

<div class="edit-add-append-view-item js_edit_add_append_view_item" data-key="{{ $key }}">
    <span class="edit-add-append-view-item-remove js_edit_add_append_view_item_remove">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>

    <div class="edit-add-append-view-input">
        <label>{{ __("admin_table.z_packages.attr_itinerary_list_title") }}</label>
        <input type="text" name="itinerary[list][{{ $key }}][title]" class="form-control"
               value="{{ @$item['title'] }}">
    </div>

    <div class="edit-add-append-view-input">
        <label>{{ __("admin_table.z_packages.attr_itinerary_list_desc") }}</label>
        <textarea id="itineraryListDesc{{ $key }}" name="itinerary[list][{{ $key }}][desc]"
                  class="form-control editor">{{ @$item['desc'] }}</textarea>
    </div>
</div>
