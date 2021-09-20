<div class="form-group">
    <label for="image">{{ @$label }}</label>

    <div class="custom-file js_edit_add_file_browse">
        <input type="text" class="custom-file-input" id="{{ $field }}" name="{{ $field }}"
               value="{{ $value }}">
        <label class="custom-file-label"
               for="{{ $field }}" data-label="{{ __("admin_global.label_action_choose_file") }}">
            {{ $value ?? __("admin_global.label_action_choose_file") }}
        </label>
    </div>
</div>
