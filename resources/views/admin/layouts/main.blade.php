@include('admin.layouts.head')
<body>
    <div id="app">
        @include('admin.layouts.sidebar')
        @include('sweetalert::alert')
        <div id="main">
           <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>{{ $title ?? "Kafi Pedia" }}</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
</body>
</html>
@include('admin.layouts.script')

