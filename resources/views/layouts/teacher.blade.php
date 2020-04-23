<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-teacher.UA-Compatible" content="IE=edge">
    <title>Teacher | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/admin/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Data table -->
    @yield('data-table-css')
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/admin/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/admin/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed {{ request()->segment(7) === 'show' ? 'sidebar-collapse' : '' }}">
<!-- Site wrapper -->
<div class="wrapper">
    @include('components.audio-alert')
    <x-teacher.navigation></x-teacher.navigation>
    <x-teacher.sidebar></x-teacher.sidebar>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('content-title')</h1>
                    </div>
                    {{--                    <div class="col-sm-6">--}}
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">Fixed Layout</li>--}}
                    {{--                        </ol>--}}
                    {{--                    </div>--}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <x-teacher.footer></x-teacher.footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<x-teacher.success-audio></x-teacher.success-audio>


<!-- jQuery -->
<script src="{{ asset('js/admin/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/admin/bootstrap.bundle.min.js') }}"></script>

<!-- Data table -->
@yield('data-table-js')

<!-- overlayScrollbars -->
<script src="{{ asset('js/admin/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/admin/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/admin/demo.js') }}"></script>

@include('sweetalert::alert')

<script src="{{ asset('js/admin/password.js') }}"></script>
@yield('extra-scripts')

</body>
</html>
