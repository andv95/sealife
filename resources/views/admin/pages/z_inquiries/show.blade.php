@extends("admin.layouts.main")

@section("pageTitle", __("admin_global.label_show")." " . __("admin_table.z_inquiries.label_title"))

@section("mainContent")
    <div class="edit-add-action-wrapper">
        @include("admin.actions.button-cancel", ["url" => route("admin.z_inquiries.index")])
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __("admin_global.label_general_info") }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="name">{{ __("admin_global.attr_name") }}</label>
                                        <p id="name">
                                            {{ __("admin_table.z_inquiries.option_title_".$data->title) ." ". $data->name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="country">{{ __("admin_global.attr_country") }}</label>
                                        <p id="country">
                                            {{ $data->country }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="email">{{ __("admin_global.attr_email") }}</label>
                                        <p id="email">
                                            {{ $data->email }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="phone">{{ __("admin_global.attr_phone") }}</label>
                                        <p id="phone">
                                            {{ $data->phone }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="special_request">{{ __("admin_table.z_inquiries.attr_special_request") }}</label>
                                        <p id="special_request">
                                            {{ $data->special_request }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="z_package_id">{{ __("admin_table.z_inquiries.attr_z_package_id") }}</label>
                                        <p id="z_package_id">
                                            @if($package = $data->zPackage)
                                                {{ $package->global_name  }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="z_room_id">{{ __("admin_table.z_inquiries.attr_z_room_id") }}</label>
                                        <p id="z_room_id">
                                            @if($room = $data->zRoom)
                                                {{ $room->global_name  }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="start_date">{{ __("admin_table.z_inquiries.attr_start_date") }}</label>
                                        <p id="start_date">
                                            {{ $data->start_date }}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="promotion_price">{{ __("admin_table.z_inquiries.attr_promotion_price") }}</label>
                                        <p id="promotion_price">
                                            {{ $data->promotion_price }} (Promotion: {{ $data->promotion_text }})
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="quantity_adults">{{ __("admin_table.z_inquiries.attr_quantity_adults") }}</label>
                                        <p id="quantity_adults">
                                            {{ $data->quantity_adults }} adults - {{ $data->quantity_children }}
                                            children - {{ $data->quantity_infants }} infants
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="transfer">{{ __("admin_table.z_inquiries.attr_transfer") }}</label>
                                        <p id="transfer">
                                            @if($transfer = $data->zTransfer)
                                                {{ $transfer->global_name  }}
                                            @endif
                                        </p>
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
    </div>
@stop
