@include('user.layout.head')
<body>
    @include('user.layout.header')
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    @include('sweetalert::alert')
    @yield('header')
    @yield('slider')
    <div class="content">
        @yield('content')
    </div>
    @include('user.layout.about')
    @include('user.layout.footer')
    @include('user.layout.script')
</body>
