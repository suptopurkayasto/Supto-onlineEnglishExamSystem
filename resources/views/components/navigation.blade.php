<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="navbar-brand" data-toggle="dropdown" href="#">
                @if(isset($admin)) {{ $admin->name }} @endif
                <img src="http://placehold.it/140x140"
                     alt="AdminLTE Logo"
                     height="30"
                     width="30"
                     class="d-inline-block align-top">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    Log out
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
