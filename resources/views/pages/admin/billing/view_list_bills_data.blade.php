@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">All Billing Details</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header"><i class="fa fa-table"></i> All Billing Details</div>
      <div class="card-body">
        <!-- content -->

        <div class="table-responsive">
            <table class="table table-bordered" id="all_bill_data_table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Bill NO</th>
                  <th>Email</th>
                  <th>Created Date</th>
                  <th>Total Amount</th>
                  <th class="no-sort">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Bill NO</th>
                  <th>Email</th>
                  <th>Created Date</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
              </tbody>
            </table>
          </div>

        <!-- content -->
      </div>
    </div>
  </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
  $(function () {
    
    var table = $('#all_bill_data_table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{ route('bills.list') }}",
         }, 
        columns: [
            {data: 'client_name', name: 'client_name'},
            {data: 'bill_no', name: 'bill_no'},
            {data: 'send_email_id', name: 'send_email_id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'action', name: 'action', orderable: true, searchable: true },
        ]
        /*order: [[ 0, "desc" ]],
        columnDefs: [ {
          'targets': [0,1,3], 
          'orderable': false, 
        }]*/
    });    
  });

  function sendMail(id){
    $("#send_mail_process").attr('action',"{{ url('lr-bill/sendmail') }}"+"/"+id)
    $("#send_mail_process").submit();
  }
</script>
@endsection