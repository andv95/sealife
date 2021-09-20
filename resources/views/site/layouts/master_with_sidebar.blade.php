@extends('site.layouts.master')

@section('content')
    <div class="main-content-sealife">
        <div class="container content-container">
            @yield('bread-crumb-sidebar')
            <div class="row row-sidebar">
                <div class="main-content-sealife-left">
                    @yield('main-content')
                </div>

                <div class="main-content-sealife-right">
                    @yield('sidebar')
                </div>
            </div>
            @yield('content-full-sidebar')
        </div>
    </div>
@stop
