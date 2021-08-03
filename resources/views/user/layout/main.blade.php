@include('user.layout.head')
<body>
    @include('user.layout.header')
    @include('sweetalert::alert')
    @yield('header')
    <div class="content">
        @yield('content')
    </div>
    @include('user.layout.about')
    @include('user.layout.footer')
    @include('user.layout.script')
</body>
