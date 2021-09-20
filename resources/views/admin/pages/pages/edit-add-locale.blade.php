@if(!$dataRoot->isFixedPage())
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
                                   class="form-control @if(!$data->getKey()) js_render_slug @endif"
                                   value="{{ old("name", $data->name) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">{{ __("admin_global.attr_slug") }}</label>
                            <input type="text" id="slug" name="slug"
                                   class="form-control js_receive_slug"
                                   value="{{ old("slug", $data->slug) }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        @php
                            $titles = old("titles", $data->titles);
                            $titles = (is_array($titles) ? $titles : []);
                        @endphp
                        <div class="form-group">
                            <label>{{ __("admin_table.pages.attr_titles") }}</label>

                            <div class="edit-add-append-view-wrapper js_edit_add_append_view_wrapper">
                                <div class="edit-add-append-view-list js_edit_add_append_view_list">
                                    @if($titles)
                                        @foreach($titles as $key => $item)
                                            @include("admin.pages.pages.sub.titles", ["item" => $item, 'key' => $key])
                                        @endforeach
                                    @else
                                        @include("admin.pages.pages.sub.titles")
                                    @endif
                                </div>
                                <div class="edit-add-append-view-action">
                                    <button data-url="{{ route("admin.pages.get_sub_view", ["view" => "titles"]) }}"
                                            type="button"
                                            class="btn btn-primary btn-sm js_edit_add_append_view_button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @include("admin.includes.multi-image-edit-add-field", [
                            'images' => old('images', $data->images),
                        ])
                    </div>

                    <div class="col-md-12">
                        @php
                            $contents = old("contents", $data->contents);
                            $contents = (is_array($contents) ? $contents : []);
                        @endphp
                        <div class="form-group">
                            <label>{{ __("admin_table.pages.attr_contents") }}</label>

                            <div class="edit-add-append-view-wrapper js_edit_add_append_view_wrapper">
                                <div class="edit-add-append-view-list js_edit_add_append_view_list">
                                    @if($contents)
                                        @foreach($contents as $key => $item)
                                            @include("admin.pages.pages.sub.contents", ["item" => $item, 'key' => $key])
                                        @endforeach
                                    @else
                                        @include("admin.pages.pages.sub.contents")
                                    @endif
                                </div>
                                <div class="edit-add-append-view-action">
                                    <button data-url="{{ route("admin.pages.get_sub_view", ["view" => "contents"]) }}"
                                            type="button"
                                            class="btn btn-primary btn-sm js_edit_add_append_view_button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endif

@include("admin.includes.seo-edit-add-area", ['data' => $data])
