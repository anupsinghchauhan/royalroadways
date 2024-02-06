<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <script src="{{ URL::asset('admin/vendor/jquery/jquery.min.js') }}"></script> --}} {{-- conflict with date picker --}}
<script src="{{ URL::asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugin JavaScript-->

<script src="{{ URL::asset('admin/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ URL::asset('admin/js/sb-admin.min.js') }}"></script>
<!-- Custom scripts for this page-->
<script src="{{ URL::asset('admin/js/sb-admin-datatables.min.js') }}"></script>
<script type="text/javascript">
function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
$( function() {
  $( "#datepicker" ).datepicker({
   dateFormat: 'dd-mm-yy' 
  })
  $( ".datepicker" ).datepicker({
   dateFormat: 'dd-mm-yy' 
  })

});

 $(document).ready(function() {
  toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "100",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "show",
      "hideMethod": "hide"
  };
});
$(document).ready(function() {
  @if (\Session::has('success'))
    toastr.success('{!! \Session::get('success') !!}');
  @endif
  @if (\Session::has('error'))
    toastr.error('{!! \Session::get('error') !!}');
  @endif
});
</script>