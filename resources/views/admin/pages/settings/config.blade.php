@extends("admin.layouts.main")

@section("pageTitle", __("admin_table.settings.label_title_config"))

@section("mainContent")
    <form class="js_server_form"
          action="{{ route("admin.settings.update_configs") }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="edit-add-action-wrapper">
            @include("admin.actions.button-cancel", ["url" => route("admin.settings.index")])
            @include("admin.actions.button-save")
        </div>

        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">{{ __("admin_table.settings.label_title_group") }}</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#setting_language_none"
                           data-toggle="tab">
                            Chung
                        </a>
                    </li>
                    @foreach($languageKeys as $item)
                        <li class="nav-item">
                            <a class="nav-link" href="#setting_language_{{ $item }}"
                               data-toggle="tab">
                                {{ strtoupper($item) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="setting_language_none">
                        <div id="accordion" class="edit-add-accordion">
                            @foreach($settings as $group => $settingItems)
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse_{{ $group }}">
                                                {{ __("admin_table.settings.option_group_". $group) }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_{{ $group }}"
                                         class="panel-collapse collapse">
                                        <div class="card-body">
                                            @foreach($settingItems as $settingItem)
                                                @include("admin.pages.settings.sub.config-item", ["settingItem" => $settingItem])
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach($languageKeys as $item)
                        <div class="tab-pane" id="setting_language_{{ $item }}">

                            <div id="accordion_{{ $item }}" class="edit-add-accordion">
                                @foreach($languageSettings as $group => $languageSettingItems)
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion_{{ $item }}"
                                                   href="#collapse_{{ $item }}_{{ $group }}">
                                                    {{ __("admin_table.settings.option_group_". $group) }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_{{ $item }}_{{ $group }}"
                                             class="panel-collapse collapse">
                                            <div class="card-body">
                                                @foreach($languageSettingItems as $settingItem)
                                                    @include("admin.pages.settings.sub.config-item", ["settingItem" => $settingItem, "locale" => $item])
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                </div>
                <!-- /.tab-content -->

            </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
    </form>
@stop
