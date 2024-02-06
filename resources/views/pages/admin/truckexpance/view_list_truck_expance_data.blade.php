@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active"><a href="{{ url('trucks/expance/create') }}">{{ __('Create Daily Trucks Details') }}</a></li>
</ol>
<!-- Icon Cards-->
<div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i>{{ __(' All Daily Trucks Details') }}</div>
      
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
              <form method="post" action="{{ url('trucks/expance/download-excel') }}" id="generate_pdf_link">
                @csrf
                <input type="hidden" id="expense_txtSearchFrom" name="expense_txtSearchFrom" value="">
                <input type="hidden" id="expense_txtSearchTo" name="expense_txtSearchTo" value="">
                <input type="hidden" id="expense_txttruckNo" name="expense_txttruckNo" value="">
                <input type="submit" class="btn btn-warning" name="generate_csv" id="generate_csv" value="Excel" style="width: 40%">
              </form>
              
          </div>
        </div>

        <div class="table-responsive">

          <table class="table table-bordered table table-bordered truck-datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Truck No.</th>
                <th>From</th>
                <th>To</th>
                <th>Rate</th>
                <th>Party Name</th>
                <th>My Expense</th>
                <th>Driver Expense</th>
                <th>Remark</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot align="right">
                <tr>
                  <th colspan="7"></th>
                  <th colspan="3"></th>
                </tr>
              </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
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
          url: "{{ URL('trucks/expance-data') }}",
           data: function (d) {
              d.txtSearchFrom = $("#txtSearchFrom").val();
              d.txtSearchTo = $("#txtSearchTo").val();
              d.txttruckNo = $("#txttruckNo").val();
           }
         }, 
        columns: [
            {data: 'daily_expase_date', name: 'daily_expase_date'},
            {data: 'truck_no', name: 'truck_no'},
            {data: 'daily_expase_date', name: 'daily_expase_date'},
            {data: 'daily_expase_date', name: 'daily_expase_date'},
            {data: 'daily_expase_date', name: 'daily_expase_date'},
            {data: 'daily_expase_date', name: 'daily_expase_date'},
            {data: 'expense', name: 'expense'},
            {data: 'driver_expense', name: 'driver_expense'},
            {data: 'expense_details', name: 'expense_details'},
            {data: 'action', name: 'action'},
        ],
        order: [[ 0, "desc" ]],
        columnDefs: [ {
          'targets': [9], 
          'orderable': false, 
        }],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
              return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };
 
          // computing column Total of the complete result 
            var my_exp = api
              .column( 6 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );

            var driver_exp = api
              .column( 7 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );
  
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 6 ).footer() ).html('My Expense Total :' +' '+my_exp+'<br/>Driver Expense Total :' + ' '+driver_exp+'<br/>Total :' +' '+ ( my_exp - driver_exp) );
            //$( api.column( 7 ).footer() ).html();
          },
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

</script>
@endsection