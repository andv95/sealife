<div class="form-group">
    <label for="active_flg">Hiển thị</label><br>
    <input type="hidden" name="active_flg" value="0">
    <input type="checkbox" id="active_flg" value="1" name="active_flg"
           @if(!$data->getKey() || $data->isActive()) checked
           @endif data-bootstrap-switch
           data-off-text="{{ __("admin_global.option_active_flg_0") }}"
           data-on-text="{{ __("admin_global.option_active_flg_1") }}"
           data-off-color="danger" data-on-color="success"
    >
</div>
