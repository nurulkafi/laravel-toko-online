    <script src="{{ asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    @stack('dashboard')
    <script src="{{ asset('admin/assets/js/script.js')}}"></script>
    <script src="{{ asset('admin/assets/js/main.js')}}"></script>
    @stack('simpleDataTable')
    @stack('order')
    @stack('simditor')
