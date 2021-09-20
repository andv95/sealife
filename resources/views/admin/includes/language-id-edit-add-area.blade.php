<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">{{ __("admin_global.label_language_select") }}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    data-toggle="tooltip"
                    title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="language_key">{{ __("admin_global.attr_language_key") }}</label>
                    <select class="form-control select2"
                            data-url="{{ route($routeName) }}" data-id="{{ $data->getKey() }}"
                            id="js_edit_add_change_language"
                            name="language_key" style="width: 100%;">
                        @foreach($languages as $item)
                            <option value="{{ $item->getLanguageKey() }}"
                                    @if($item->getLanguageKey() === old("language_key", $data->language_key)) selected @endif>
                                {{ $item->getName() }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
