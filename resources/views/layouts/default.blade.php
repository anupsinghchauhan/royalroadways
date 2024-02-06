@include('includes.head') {{-- head file --}}
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  @include('includes.left-fixed-navigation') {{-- left side bar menu --}}

  <div class="content-wrapper">
    <div class="container-fluid">
      @yield('content')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © RoyalRoadWays {{ date('Y') }}</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    @include('includes.footer-script') {{-- footer file --}}
    @yield('javascript')
  </div>
</body>
</html>