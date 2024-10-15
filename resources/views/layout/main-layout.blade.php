<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Дашборд</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    @include('layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page_title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @foreach($breadcrumbs as $breadcrumb)
                                @if($breadcrumb['active'])
                                    <li class="breadcrumb-item active"><a href="{{$breadcrumb['link']}}">{{$breadcrumb['name']}}</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="{{$breadcrumb['link']}}">{{$breadcrumb['name']}}</a></li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">@yield('block_title')</h3>
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layout.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/js/demo.js"></script>
</body>
</html>
