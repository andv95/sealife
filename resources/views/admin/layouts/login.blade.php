@extends("admin.layouts.master")

@section("bodyClass", "login-page")

@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0);"><b>{{ setting("app_name", config("app.name")) }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @yield("loginContent")
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@stop
