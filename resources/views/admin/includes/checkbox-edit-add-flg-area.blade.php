<div class="form-group clearfix">
    <label>{{ $label }}</label><br>
    <input type="hidden" name="{{ $field }}" value="0">
    <div class="icheck-primary d-inline">
        <input type="checkbox" id="{{ $field }}" name="{{ $field }}" value="1"
               @if((!$data->getKey() && (!isset($defaultChecked) || $defaultChecked)) || old($field, $data->{$field})) checked @endif>
        <label for="{{ $field }}"></label>
    </div>
</div>
