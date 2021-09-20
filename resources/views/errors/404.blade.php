@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="page-404">
        <div class="main404">
            <div class="container404"><h1>404</h1>
                <p>{{ setting('site.text_404') }}</p>
                <div><a href="/">{{ __('site_global.label_back_to_home') }}</a><a href="javascript:void(0);" onclick="window.history.back();">{{ __('site_global.label_back_page') }}</a></div>
            </div>
        </div>
    </div>
@endsection

