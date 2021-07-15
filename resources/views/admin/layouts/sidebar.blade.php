<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item @yield('Dashboard')">
                            <a href="{{ url('admin/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Categories')">
                            <a href="{{ url('admin/categories') }}" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Product')">
                            <a href="{{ url('admin/product') }}" class='sidebar-link'>
                                <i class="bi bi-box"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Users & Roles</li>
                        <li class="sidebar-item @yield('Users')">
                            <a href="{{ url('admin/users') }}" class='sidebar-link'>
                                <i class="bi bi-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Role')">
                            <a href="{{ url('admin/role') }}" class='sidebar-link'>
                                <i class="bi bi-box"></i>
                                <span>Role</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Alert</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Badge</a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
