@extends('layouts.default')
@section('stylesheet')
<style>
.ctmtable{font-size:14px!important}
.ctmtable font{font-size:14px!important}
</style>
@endsection
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
    <div class="card-header"><i class="fa fa-table"></i>{{ __(' Monthly Pending Payment') }}
    <a href="javascript:void(0)" class="btn btn-warning" name="generate_pdf_frm" id="generate_pdf_frm"> {{__('Generate PDF')}}</a>
   </div>
    
      <div class="card-body">
        <div class="row">
         @include('pages.admin.monthlypending.monthly_pending_party_bill_pdf')
        </div>        
      </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
  </div>
  <form method="post" action="{{URL('monthly-pending-party-bill/download-pdf')}}" id="generate_pdf_frm_link">
    @csrf
    <input type="hidden" id="pdf_txtSearchFrom" name="pdf_txtSearchFrom" value="{{$txtSearchFrom}}">
    <input type="hidden" id="pdf_txtSearchTo" name="pdf_txtSearchTo" value="{{$txtSearchTo}}">
    <input type="hidden" id="party_name" name="party_name" value="{{$party_name}}">
    <input type="hidden" id="lr_mode_txt" name="lr_mode_txt" value="{{$lr_mode_txt}}">
  </form>

  <!-- Modal -->
  <div class="modal fade" id="UpdatePayment" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
          <div class="modal-content">
            <div class="card-header" style="text-align:center">Update Payment
            <div>
              <span style="float: right;font-size: 12px;"><b>Consignee: </b><span id="consignee_name"></span></span>
              <span style="float: left;font-size: 12px;"><b>Consignor: </b><span id="consignor_name"></span></span>
            </div>
            </div>
            <div class="modal-body">
              <form method="post" id="r_amount_frm">
                <input type="hidden" id="r_pending_paymet_party_id" name="r_pending_paymet_party_id">
                <div class="form-row">
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="r_amount" name="r_amount" value="" any>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" class="btn btn-primary btn-block" id="save_r_payment">Update</button>
                  </div>
                </div>
              
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
    <!-- Modal -->
@stop

@section('javascript')
<script type="text/javascript">
  
   $("#generate_pdf_frm").click(function(){
      $("#wait").show();
      $("#generate_pdf_frm_link").submit();
      $("#wait").hide();
   });

  function UpdatePayment(pending_paymet_party_id,consignee,consignor){

    $("#r_pending_paymet_party_id").val(pending_paymet_party_id);
    $("#consignee_name").text(consignee);
    $("#consignor_name").text(consignor);
    $("#UpdatePayment").modal('show');
  }

 function DeleteLRData(url){
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
          setTimeout(location.reload.bind(location), 2000);
        },
        error: function() {
          $(document.body).css({'cursor' : 'default'});
            toastr.error('Oops..!! something went wrong please try again.');
          }
      });
  }
    
  
 }

  $(document).on('click', '#save_r_payment', function(){
    
    var r_amount = $("#r_amount").val();
    var r_pending_paymet_party_id = $("#r_pending_paymet_party_id").val();
    $.ajax({
      type        : "POST",
      url         : '{{ URL('save-payment') }}',
      data        : { 
        r_amount : r_amount,
        r_pending_paymet_party_id:r_pending_paymet_party_id,
        "_token": "{{ csrf_token() }}"
      },
      success: function(results) {
        $(document.body).css({'cursor' : 'default'});
        const obj = JSON.parse(results);
        if(obj.result == 1){
          toastr.success(obj.message);
        }else{
          toastr.error(obj.message);
        }
        $("#UpdatePayment").modal('hide');
        setTimeout(location.reload.bind(location), 2000);
      },
      error: function() {
        $(document.body).css({'cursor' : 'default'});
          toastr.error('Oops..!! something went wrong please try again.');
        }
    });
  });
</script>
@endsection