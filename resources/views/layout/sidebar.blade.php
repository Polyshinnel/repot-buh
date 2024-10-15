<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">Кидсберри отчеты</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">@yield('username')</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Дашборд
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/payments" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Платежи
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/returning" class="nav-link">
                        <i class="nav-icon fas fa-retweet"></i>
                        <p>
                            Возвраты
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/settings" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Настройки
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
