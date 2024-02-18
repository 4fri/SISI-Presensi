<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->photo !== null)
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                        alt="User">
                @else
                    <i class="fas fa-user fa-2x"></i>
                @endif
            </div>
            <div class="info">
                <a class="d-block" href="#">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            @role('admin')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                                                                                                                               with font-awesome or any other icon font library -->
                    <li class="nav-header">ADMIN</li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Manajemen User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('index_users') }}" class="nav-link">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('index_user_role') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">DATA EMPLOYEE</li>
                    <li class="nav-item">
                        <a href="{{ route('index_position') }}" class="nav-link">
                            <i class="fas fa-square nav-icon"></i>
                            <p>Master Positions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Employees</p>
                        </a>
                    </li>
                </ul>
            @endrole
            @role('employee')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-square nav-icon"></i>
                            <p>Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Furlough</p>
                        </a>
                    </li>
                </ul>
            @endrole
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="container my-3">
        <div class="row">
            <div class="col">
                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm dropdown" data-toggle="dropdown"
                    onclick="event.preventDefault(); confirm('Are you sure you want to logout?'); document.getElementById('logout-form').submit();">
                    <i class="fas fa-arrow-right"></i> Logout
                </a>
            </div>
            <div class="col">
                <a href="{{ route('profile_employee') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>
