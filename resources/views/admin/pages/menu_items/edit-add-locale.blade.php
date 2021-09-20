<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ __("admin_global.label_general_info") }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">{{ __("admin_global.attr_name") }}</label>
                        <input type="text" id="name" name="name"
                               class="form-control"
                               value="{{ old("name", $data->name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url">{{ __("admin_table.menu_items.attr_url") }}</label>
                        <input type="text" id="url" name="url"
                               class="form-control"
                               value="{{ old("url", $data->url) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label
                            for="open_target">{{ __("admin_table.menu_items.attr_open_target") }}</label>
                        <select class="form-control select2" id="open_target" name="open_target"
                                style="width: 100%;">
                            @foreach(\App\Models\MenuItem::OPEN_TARGETS as $item)
                                <option value="{{ $item }}"
                                        @if($item == old("open_target", $data->open_target)) selected @endif>
                                    {{ $item }}
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
</div>
