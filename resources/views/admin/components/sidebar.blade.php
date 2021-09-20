<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route("admin.home") }}" class="brand-link">
        <img src="{{ asset("admin_assets/templates/admin-lte3/dist/img/AdminLTELogo.png") }}"
             alt="{{ setting("app_name", config("app.name")) }}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ setting("app_name", config("app.name")) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset("admin_assets/templates/admin-lte3/dist/img/user2-160x160.jpg") }}"
                     class="img-circle elevation-2" alt="{{ currentUser()->getName() }}">
            </div>
            <div class="info">
                <a href="{{ route("admin.users.edit", currentUser()->getKey()) }}" class="d-block"
                   title="{{ currentUser()->getName() }}">{{ currentUser()->getName() }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            {!! \App\Helpers\AdminHelper::getHtmlAdminMenus() !!}
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
