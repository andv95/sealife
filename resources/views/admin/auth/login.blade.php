@extends("admin.layouts.login")

@section("pageTitle", __("admin_global.title_login_page"))

@section("loginContent")
    <p class="login-box-msg">{{ __("admin_auth.label_sign_in_to_start_session") }}</p>

    @if($errors->count())
        @include("admin.includes.messages-area", ["messages" => $errors->all()])
    @endif

    <form class="js_server_form" action="{{ route("admin.login") }}" method="post" autocomplete="off">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __("admin_auth.label_email") }}"
                   autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control"
                   placeholder="{{ __("admin_auth.label_password") }}" autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                {{--<div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        {{ __("admin_auth.label_remember_me") }}
                    </label>
                </div>--}}
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit"
                        class="btn btn-primary btn-block">{{ __("admin_auth.label_sign_in") }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{--<div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
    </div>--}}
    <!-- /.social-auth-links -->

    {{--<p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
    </p>
    <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
    </p>--}}
@stop
