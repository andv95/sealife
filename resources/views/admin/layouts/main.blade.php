@extends("admin.layouts.master")

@section("bodyClass", "sidebar-mini")

@section("content")
    <!-- Site wrapper -->
    <div class="wrapper">

    @include("admin.components.navbar")

    @include("admin.components.sidebar")

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

        @include("admin.components.breadcrumbs")

        <!-- Main content -->
            <section class="content">

                <div class="global-messages-area">
                    @if($errors->count())
                        @include("admin.includes.messages-area", ["messages" => $errors->all()])
                    @endif

                    @if(session()->has("errorMessages"))
                        @include("admin.includes.messages-area", ["messages" => session()->get("errorMessages")])
                    @endif

                    @if(session()->has("successMessages"))
                        @include("admin.includes.messages-area", ["messages" => session()->get("successMessages"), "type" => "success"])
                    @endif
                </div>

                <div id="js_global_messages_area" class="global-messages-area"></div>

                @yield("mainContent")

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include("admin.components.footer")
    </div>
    <!-- ./wrapper -->
@stop
