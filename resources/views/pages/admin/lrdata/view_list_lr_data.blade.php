@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active"><a href="{{ url('lr-bill/create-bill') }}">{{ __('Create Bill') }}</a></li>
</ol>
<!-- Icon Cards-->
<div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i>{{ __(' All Billing Details') }}</div>
      
      <div class="card-body">
        <div class="row">
          <div class="col-sm-9">
           
              <div class="form-group">
                <div class="form-row">
                   <div class="col-md-2">
                    <input class="form-control datepicker" id="txtSearchFrom" type="text" name="txtSearchFrom" placeholder="From" value="{{$txtSearchFrom}}" readonly >
                  </div>
                  <div class="col-md-2">
                    <input class="form-control datepicker" id="txtSearchTo" type="text" name="txtSearchTo" placeholder="To" value="{{$txtSearchTo}}" readonly>
                  </div>
                  <div class="col-md-2">
                    <input class="form-control" id="txtSearch" type="text" name="txtSearch" placeholder="Search">
                  </div>
                  <div class="col-md-4">
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
          <div class="col-sm-3">
              <form method="post" action="{{ url('lr-bill/download-excel') }}" id="generate_pdf_link">
                @csrf
                <input type="hidden" id="pdf_txtSearchFrom" name="pdf_txtSearchFrom" value="">
                <input type="hidden" id="pdf_txtSearchTo" name="pdf_txtSearchTo" value="">
                <input type="hidden" id="pdf_txtSearch" name="pdf_txtSearch" value="">
                <input type="hidden" id="lr_mode_txt" name="lr_mode_txt" value="{{ lr_mode }}">
                <input type="hidden" id="site_master_id_txt" name="site_master_id_txt" value="{{ $site_master_id }}">
                <input type="submit" class="btn btn-warning" name="generate_pdf" id="generate_pdf" value="Generate Excel">
              </form>
              
          </div>
        </div>

        <div class="table-responsive">

          <table class="table table-bordered table table-bordered lrbill-datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Email</th>
                <th>LR NO</th>
                <th>Truckno</th>
                <th>Bill Date</th>
                <th>From</th>
                <th>To</th>
                <th>Total Amount</th>
                <th class="no-sort">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Email</th>
                <th>LR NO</th>
                <th>Truckno</th>
                <th>Bill Date</th>
                <th>From</th>
                <th>To</th>
                <th>Total Amount</th>
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
  <form method="post" action="" id="send_mail_process"> @csrf</form>
@stop
@section('javascript')
<script type="text/javascript">
  $(function () {
    
    var table = $('.lrbill-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{ route('lr.ajax-list') }}",
           data: function (d) {
              d.txtSearchFrom = $('#txtSearchFrom').val(),
              d.txtSearchTo = $('#txtSearchTo').val(),
              d.txtSearch = $('#txtSearch').val(),
              //d.current_year = $('#current_year').val(),
              d.lr_mode = $('#lr_mode').val()
           }
         }, 
        columns: [
            {data: 'royal_email', name: 'royal_email'},
            {data: 'lrno', name: 'lrno'},
            {data: 'truckno', name: 'truckno'},
            {data: 'royal_date', name: 'royal_date'},
            {data: 'royal_from', name: 'royal_from'},
            {data: 'royal_to', name: 'royal_to'},
            {data: 'royal_amount', name: 'royal_amount'},
            {data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('#txtSearchFrom,#txtSearchTo,#lr_mode,#txtSearch').change(function(){
      table.draw();
      $("#pdf_txtSearchFrom").val($("#txtSearchFrom").val());
      $("#pdf_txtSearchTo").val($("#txtSearchTo").val());
      $("#pdf_txtSearch").val($("#txtSearch").val());
      //$("#lr_current_year").val($("#current_year").val());
      $("#lr_mode_txt").val($("#lr_mode").val());
    });
    $('#searchSubmit').on('click', function(e) {
        table.draw();
        e.preventDefault();
        //alert('sdfs');
    });
    
  });

  function sendMail(id){
    $("#send_mail_process").attr('action',"{{ url('lr-bill/sendmail') }}"+"/"+id)
    $("#send_mail_process").submit();
  }

</script>
@endsection