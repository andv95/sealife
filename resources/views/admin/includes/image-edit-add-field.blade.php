@php
    $image = (is_array(@$image) ? $image : []);
    $field = (!empty($field) ? $field : 'image');
    $id = (!empty($id) ? $id : $field);
    $multiple = !empty($multiple);
    $defaultLabel = __("admin_global.attr_image");

    $params = (!empty($params) ? $params : []);

    if($multiple) {
        $key = (is_numeric(@$key) ? $key : 0);
        $field = (!empty($field) ? $field : 'images');
        $id = "{$id}_{$key}";
        $field .= "[{$key}]";
        $defaultLabel = __("admin_global.attr_images");
    }
@endphp

<div
    class="form-group js_edit_add_image_field @if($multiple) edit-add-append-view-item js_edit_add_append_view_item @endif"
    @if($multiple) data-key="{{ $key }}" @endif
>
    @if(!$multiple)
        <label for="image">{{ @$label ?: $defaultLabel }}</label>
    @else
        <span class="edit-add-append-view-item-remove js_edit_add_append_view_item_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>
    @endif

    <div class="row">
        <div class="col-md-5">
            <div class="js_edit_add_exist_image edit-add-exist-image"
                 data-label="{{ __("admin_global.label_action_no_image") }}">
                @if(!empty($image['url']))
                    <img src="{{ $image['url'] }}" alt="image">
                @else
                    <p>{{ __("admin_global.label_action_no_image") }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="custom-file js_edit_add_image_browse">
                        <input type="text" class="custom-file-input" id="{{ $id }}" name="{{ $field }}[url]"
                               value="{{ @$image['url'] }}">
                        <label class="custom-file-label"
                               for="{{ $id }}" data-label="{{ __("admin_global.label_action_choose_file") }}">
                            @if(!empty($image['url']))
                                {{ $image['url'] }}
                            @else
                                {{ __("admin_global.label_action_choose_file") }}
                            @endif
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="text" name="{{ $field }}[title]" class="form-control"
                           placeholder="{{ __("admin_global.attr_image_title") }}" value="{{ @$image['title'] }}">
                </div>

                <div class="col-md-6">
                    <input type="text" name="{{ $field }}[alt]" class="form-control"
                           placeholder="{{ __("admin_global.attr_image_alt") }}" value="{{ @$image['alt'] }}">
                </div>

                @if($multiple)
                    <div class="col-md-6 mt-2">
                        <input type="number" name="{{ $field }}[order_no]" class="form-control"
                               placeholder="{{ __("admin_global.attr_image_order_no") }}"
                               value="{{ @$image['order_no'] }}" min="0">
                    </div>
                @endif

                @if(!empty($params['video_url']))
                    <div class="col-md-12 mt-2">
                        <input type="text" name="{{ $field }}[video_url]" class="form-control"
                               placeholder="{{ __("admin_global.attr_image_video_url") }}"
                               value="{{ @$image['video_url'] }}">
                    </div>
                @endif

                @if(!empty($params['link']))
                    <div class="col-md-12 mt-2">
                        <input type="text" name="{{ $field }}[link]" class="form-control"
                               placeholder="{{ __("admin_global.attr_link") }}"
                               value="{{ @$image['link'] }}">
                    </div>
                @endif
            </div>
        </div>

        {{--@if(!$multiple)
            <div class="col-md-1">
                <div class="js_edit_add_image_remove edit-add-remove-image">
                <span class="text-danger" title="{{ __("admin_global.label_action_remove_image") }}"><i
                        class="fa fa-times" aria-hidden="true"></i></span>
                </div>
            </div>
        @endif--}}
    </div>
</div>
