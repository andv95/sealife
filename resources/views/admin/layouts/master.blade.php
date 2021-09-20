<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ setting("app_name", config("app.name")) }} | @yield("pageTitle")</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@include("admin.includes.multi-lang")

<!-- Font Awesome -->
    <link rel="stylesheet"
          href="{{ asset("admin_assets/templates/admin-lte3/plugins/fontawesome-free/css/all.min.css") }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("admin_assets/templates/admin-lte3/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet"
          href="{{ asset("admin_assets/templates/admin-lte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">

    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset("admin_assets/templates/admin-lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css") }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet"
          href="{{ asset("admin_assets/templates/admin-lte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("admin_assets/templates/admin-lte3/dist/css/adminlte.min.css") }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- File Manager package -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

    <!-- Customer style -->
    <link rel="stylesheet" href="{{ asset("admin_assets/css/style.css") }}">

    @yield('css')
</head>
<body class="hold-transition @yield('bodyClass')">

@yield("content")

<!-- Loading (remove the following to stop the loading)-->
<div id="js_overlay_wrapper" style="display: none">
    <div class="overlay">
        <i class="fas fa-2x fa-sync-alt"></i>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset("admin_assets/templates/admin-lte3/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("admin_assets/templates/admin-lte3/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

<!-- Select2 -->
<script src="{{ asset("admin_assets/templates/admin-lte3/plugins/select2/js/select2.full.min.js") }}"></script>

<!-- DataTables -->
<script src="{{ asset("admin_assets/templates/admin-lte3/plugins/datatables/jquery.dataTables.js") }}"></script>
<script
    src="{{ asset("admin_assets/templates/admin-lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js") }}"></script>

<!-- Bootstrap Switch -->
<script
    src="{{ asset("admin_assets/templates/admin-lte3/plugins/bootstrap-switch/js/bootstrap-switch.min.js") }}"></script>

<!-- Ck editor -->
<script src="{{ asset("admin_assets/plugins/ckeditor/ckeditor.js") }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset("admin_assets/templates/admin-lte3/dist/js/adminlte.min.js") }}"></script>

<!-- File Manager package -->
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<!-- Customer script -->
<script src="{{ asset("admin_assets/js/system.js") }}"></script>
<script src="{{ asset("admin_assets/js/script.js") }}"></script>

@yield("js")

</body>
</html>
