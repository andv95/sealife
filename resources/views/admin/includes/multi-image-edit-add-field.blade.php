@php
    $field = (!empty($field) ? $field : "images");
    $images = (is_array(@$images) ? $images : []);

    $label = (!empty($label) ? $label : __("admin_global.attr_images"));
    $params = (!empty($params) ? $params : []);
@endphp
<div class="form-group">
    <label>{{ $label }}</label>

    <div class="edit-add-append-view-wrapper js_edit_add_append_view_wrapper"
         data-params="{{ \App\Helpers\Helper::jsonEncode(["field" => $field, "id" => @$id, 'params' => $params]) }}">
        <div class="edit-add-append-view-list js_edit_add_append_view_list">
            @if($images)
                @foreach($images as $key => $image)
                    @include("admin.includes.image-edit-add-field", [
                        'image' => $image,
                        'multiple' => true,
                        "id" => @$id,
                        'key' => $key,
                        'params' => $params
                    ])
                @endforeach
            @else
                @include("admin.includes.image-edit-add-field", ['multiple' => true, "id" => @$id, 'params' => $params])
            @endif
        </div>
        <div class="edit-add-append-view-action">
            <button data-url="{{ !empty($urlGetMoreView) ? $urlGetMoreView : route("admin.get_edit_add_image_field") }}"
                    type="button"
                    class="btn btn-primary btn-sm js_edit_add_append_view_button">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>
