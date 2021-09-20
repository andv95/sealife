@php
    use App\Models\Setting;
    /**
    * @var Setting $settingItem
    */
    $locale = (!empty($locale) ? $locale : null);

    if($locale) {
        $oldKey = $settingItem->group.".". $settingItem->key.".".$locale. ".translated_value";
        $id = $settingItem->group."_". $settingItem->key."_".$locale. "_translated_value";
        $name = "{$settingItem->group}[{$settingItem->key}][{$locale}][translated_value]";
    }else {
        $oldKey = $settingItem->group.".".$settingItem->key. ".value";
        $id = $settingItem->group."_".$settingItem->key. "_value";
        $name = "{$settingItem->group}[{$settingItem->key}][value]";
    }

    $value = $settingItem->getValue($locale);
    $type = $settingItem->type;
    $displayName = $settingItem->display_name;
@endphp

@if($type == \App\Models\Setting::TYPE_TEXTAREA || $type == \App\Models\Setting::TYPE_CK_EDITOR)
    <div class="form-group">
        <label
            for="{{ $id }}">{{ $displayName }}</label>
        <textarea id="{{ $id }}"
                  name="{{ $name }}"
                  class="form-control @if($type == \App\Models\Setting::TYPE_CK_EDITOR) editor @endif">{{ old($oldKey, $value) }}</textarea>
    </div>
@elseif($type == \App\Models\Setting::TYPE_IMAGE)
    @include("admin.includes.image-edit-add-field", [
        "field" => $name,
        "id" => $id,
        "image" => old($oldKey, $value),
        "label" => $displayName
    ])
@elseif($type == \App\Models\Setting::TYPE_MULTI_IMAGES)
    @include("admin.includes.multi-image-edit-add-field", [
        "field" => $name,
        "id" => $id,
        "images" => old($oldKey, $value),
        "label" => $displayName
    ])
@else
    <div class="form-group">
        <label
            for="{{ $id }}">{{ $displayName }}</label>
        <input type="text" id="{{ $id }}"
               name="{{ $name }}"
               class="form-control"
               value="{{ old($oldKey, $value) }}">
    </div>
@endif
