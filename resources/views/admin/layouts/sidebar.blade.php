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
                        <li class="sidebar-title">General</li>
                        <li class="sidebar-item @yield('Dashboard')">
                            <a href="{{ url('admin/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Slider')">
                            <a href="{{ url('admin/slider') }}" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Slider</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Catalog</li>
                        <li class="sidebar-item @yield('Categories')">
                            <a href="{{ url('admin/categories') }}" class='sidebar-link'>
                                <i class="bi bi-list"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Product') @yield('sub-product')">
                            <a href="{{ url('admin/product') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Products</span>
                            </a>
                            @yield('submenu-product')
                        </li>
                        <li class="sidebar-title">Orders</li>
                        <li class="sidebar-item @yield('Orders') @yield('sub') ">
                            <a href="{{ url('admin/order') }}" class='sidebar-link'>
                                <i class="bi bi-cart-fill"></i>
                                <span>Orders</span>
                                <span class="badge bg-danger">+{{ count($newOrders) }}</span>
                            </a>
                            @yield('submenu')
                        </li>
                        <li class="sidebar-title">Users & Roles</li>
                        <li class="sidebar-item @yield('Users')">
                            <a href="{{ url('admin/users') }}" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('Role')">
                            <a href="{{ url('admin/role') }}" class='sidebar-link'>
                                <i class="bi bi-lock-fill"></i>
                                <span>Role</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Reports</li>
                        @php
                            $yearNow = date("Y");
                        @endphp
                        <li class="sidebar-item @yield('Revenue')">
                            <a href="{{ url('admin/report/revenue/'.$yearNow) }}" class='sidebar-link'>
                                <i class="bi bi-wallet-fill"></i>
                                <span>Revenue</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
