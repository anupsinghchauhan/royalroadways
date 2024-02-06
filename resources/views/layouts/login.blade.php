<!DOCTYPE HTML>
<html>
    <head>
        @include('includes.head')
    </head> 
    <body class="bg-dark">
    @yield('content')
        <!-- Bootstrap core JavaScript-->
        <script src="{{ URL::asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ URL::asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    </body>
</html>