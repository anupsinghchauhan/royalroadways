@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">{{ __('Monthly Pending Payment') }}</li>
</ol>
<!-- Icon Cards-->
<div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i>{{ __(' Monthly Pending Payment') }}</div>
      
      <div class="card-body">
        <div class="row">
          <div class="col-sm-9">
           
              <div class="form-group">
                <div class="form-row">
                   <div class="col-md-3">
                    <input class="form-control datepicker" id="txtSearchFrom" type="text" name="txtSearchFrom" placeholder="From" readonly>
                  </div>
                  <div class="col-md-3">
                    <input class="form-control datepicker" id="txtSearchTo" type="text" name="txtSearchTo" placeholder="To" readonly>
                  </div>
                  <div class="col-md-3">
                    <select name="lr_mode" id="lr_mode" class="form-control">
                      @foreach(ArrFilters() as $key => $Arr)
                      <option value="{{$key}}" {{ ($key == lr_mode)?'selected':'' }}>{{$Arr}}</option>
                      @endforeach
                    </select>
                  </div>
                 
                  <div class="col-md-2">
                    <a href="javascript:void(0)"class="btn btn-success" name="searchSubmit" id="searchSubmit"> Search </a>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="table-responsive">

          <table class="table table-bordered table table-bordered lrbill-datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>NO</th>
                <th>Party Name</th>
                <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>NO</th>
                  <th>Party Name</th>
                  <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
  </div>
  <form method="post" action="" id="generate_pdf_link">
    @csrf
    <input type="hidden" id="pdf_txtSearchFrom" name="pdf_txtSearchFrom" value="">
    <input type="hidden" id="pdf_txtSearchTo" name="pdf_txtSearchTo" value="">
    <input type="hidden" id="party_name" name="party_name" value="">
    <input type="hidden" id="lr_mode_txt" name="lr_mode_txt" value="<?php echo lr_mode; ?>">
  </form>
@stop

@section('javascript')
<script type="text/javascript">
  $(function () {
    var i = 1;
    var table = $('.lrbill-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{ route('monthly-pending-party-bill.list') }}",
           data: function (d) {
              d.txtSearchFrom = $("#txtSearchFrom").val();
              d.txtSearchTo = $("#txtSearchTo").val();
              d.lr_mode = $("#lr_mode").val();
           }
         }, 
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'party_name', name: 'party_name'},
            {data: 'action', name: 'action'},
        ],
        //order: [[ 0, "desc" ]],
        columnDefs: [ {
          'targets': [0,2], 
          'orderable': false, 
        }]
    });

    $('#txtSearchFrom,#txtSearchTo,#current_year,#lr_mode').change(function(){
      table.draw();
      $("#pdf_txtSearchFrom").val($("#txtSearchFrom").val());
      $("#pdf_txtSearchTo").val($("#txtSearchTo").val());
      $("#lr_current_year").val($("#current_year").val());
      $("#lr_mode_txt").val($("#lr_mode").val());
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

  function MonthyPendingPartyForm(party_name){
  $("#wait").show();
  $('#generate_pdf_link').attr('action', "{{URL('monthly-pending-party-bill/view')}}");
  $("#pdf_txtSearchFrom").val($("#txtSearchFrom").val());
  $("#pdf_txtSearchTo").val($("#txtSearchTo").val());
  $("#lr_mode_txt").val($("#lr_mode").val());
  $("#party_name").val(party_name);
  window.setTimeout(function() { $("#generate_pdf_link").submit(); }, 500);
}

function DeleteMonthlyData(url){
  var c = confirm('Are you sure you want to delete?');
  
  if(c){
      $.ajax({
        type        : "GET",
        url         : url,
        success: function(results) {
          $(document.body).css({'cursor' : 'default'});
          const obj = JSON.parse(results);
          if(obj.result == 1){
            toastr.success(obj.message);
          }else{
            toastr.error(obj.message);
          }
          //setTimeout(location.reload.bind(location), 2000);
        },
        error: function() {
          $(document.body).css({'cursor' : 'default'});
            toastr.error('Oops..!! something went wrong please try again.');
          }
      });
  }
    
  
 }
</script>
@endsection