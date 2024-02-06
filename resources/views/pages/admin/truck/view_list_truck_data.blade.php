@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">{{ __('Daily Trucks Details') }}</li>
</ol>
<!-- Icon Cards-->
<div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i>{{ __(' Daily Trucks Details') }}</div>
      
      <div class="card-body">
        <div class="row">
          <div class="col-sm-9">
           
              <div class="form-group">
                <div class="form-row">
                   <div class="col-md-2">
                   <input class="form-control datepicker" id="txtSearchFrom" type="text" name="txtSearchFrom" placeholder="From" readonly>
                  </div>
                  <div class="col-md-2">
                  <input class="form-control datepicker" id="txtSearchTo" type="text" name="txtSearchTo" placeholder="To" readonly>
                  </div>
                  <div class="col-md-3">
                      <select name="txttruckNo" id="txttruckNo" class="form-control">
                        <option value="">Select</option>
                        <?php $Arrtruck = all_truck_arr(); ?>
                        <?php foreach ($Arrtruck as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo strtoupper($value); ?></option>
                        <?php } ?>
                      </select>
                    </div>                 
                  <div class="col-md-2">
                    <a href="javascript:void(0)"class="btn btn-success" name="searchSubmit" id="searchSubmit"> Search </a>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-sm-3">
              <form method="post" action="{{ url('trucks/download-excel') }}" id="generate_pdf_link">
                @csrf
                <input type="hidden" id="expense_txtSearchFrom" name="expense_txtSearchFrom" value="">
                <input type="hidden" id="expense_txtSearchTo" name="expense_txtSearchTo" value="">
                <input type="hidden" id="expense_txttruckNo" name="expense_txttruckNo" value="">
                <input type="submit" class="btn btn-warning" name="generate_pdf" id="generate_pdf" value="View Truck Expense">
              </form>
              
          </div>
        </div>

        <div class="table-responsive">

          <table class="table table-bordered table table-bordered truck-datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                  <th>Driver</th>
                  <th>Date</th>
                  <th>Truck No</th>
                  <th>From</th>
                  <th>To</th>
                  <th class="no-sort">Material</th>
                  <th class="no-sort">Payment</th>
                  <th class="no-sort">Money (Rate)</th>
                  <th class="no-sort">Money Taken advanced</th>
                  <th class="no-sort">Km</th>
                  <th class="no-sort">Diesel</th>
                  <th class="no-sort">Diesel Amount</th>
                  <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Driver</th>
                  <th>Date</th>
                  <th>Truck No</th>
                  <th>From</th>
                  <th>To</th>
                  <th class="no-sort">Material</th>
                  <th class="no-sort">Payment</th>
                  <th class="no-sort">Money (Rate)</th>
                  <th class="no-sort">Money Taken advanced</th>
                  <th class="no-sort">Km</th>
                  <th class="no-sort">Diesel</th>
                  <th class="no-sort">Diesel Amount</th>
                  <th class="no-sort">Action</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
  </div>
  <form method="post" action="" id="send_mail_process"> @csrf</form>
@stop
@section('javascript')
<script type="text/javascript">
  $(function () {
    
    var table = $('.truck-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{ route('all-truck.list') }}",
           data: function (d) {
              d.txtSearchFrom = $("#txtSearchFrom").val();
              d.txtSearchTo = $("#txtSearchTo").val();
              d.txttruckNo = $("#txttruckNo").val();
           }
         }, 
        columns: [
            {data: 'created_user', name: 'created_user'},
            {data: 'expense_date', name: 'expense_date'},
            {data: 'truck_no', name: 'truck_no'},
            {data: 'expense_from', name: 'expense_from'},
            {data: 'expense_to', name: 'expense_to'},
            {data: 'expense_material', name: 'expense_material'},
            {data: 'expense_payment_mode', name: 'expense_payment_mode'},
            {data: 'expense_money', name: 'expense_money'},
            {data: 'expense_money_adv_taken', name: 'expense_money_adv_taken'},
            {data: 'expense_km', name: 'expense_km'},
            {data: 'expense_diesel', name: 'expense_diesel'},
            {data: 'diesel_amount', name: 'diesel_amount'},
            {data: 'action', name: 'action', orderable: true, searchable: true },
        ]
        /*order: [[ 0, "desc" ]],
        columnDefs: [ {
          'targets': [0,1,3], 
          'orderable': false, 
        }]*/
    });

    $('#txtSearchFrom,#txtSearchTo,#txttruckNo').change(function(){
      table.draw();
      //$("#pdf_txtSearchFrom").val($("#txtSearchFrom").val());
      //$("#pdf_txtSearchTo").val($("#txtSearchTo").val());
      //$("#lr_current_year").val($("#current_year").val());
    });
    $('#searchSubmit').on('click', function(e) {
        table.draw();
        e.preventDefault();
        //alert('sdfs');
    });
    
  });

  function sendMail(id){
    $("#send_mail_process").attr('action',"{{ url('lr-bill/send-mail-process') }}"+"/"+id)
    $("#send_mail_process").submit();
  }

</script>
@endsection