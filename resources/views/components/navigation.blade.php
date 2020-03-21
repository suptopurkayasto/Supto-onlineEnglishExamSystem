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
                @auth('admin') {{ auth()->guard('admin')->user()->name }} @endauth
                <img src="{{ Gravatar::get(auth()->guard('admin')->user()->email) }}"
                     alt="AdminLTE Logo"
                     height="30"
                     width="30"
                     class="d-inline-block align-top">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <button onclick="document.getElementById('admin-logout-form').submit()" class="dropdown-item">
                    Log out
                </button>
                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="post">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
