<div class="form-group">
    <label
        for="api_id">{{ __("admin_global.attr_api_id") }}</label>
    <select class="form-control select2" id="api_id" name="api_id"
            style="width: 100%;">
        <option value=""></option>
        @foreach($apiIds as $item)
            <option value="{{ @$item['id_random'] }}"
                    @if(@$item['id_random'] == old("api_id", $data->api_id)) selected @endif>
                {{ @$item['title'] }}
            </option>
        @endforeach
    </select>
</div>
