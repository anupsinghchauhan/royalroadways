@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('dashboard')}}">{{__('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">@if($mode=="add") {{__('Create Bill')}} @else{{__('Update Bill')}} @endif</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul style="margin: 0;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
      <div class="card-header">@if($mode=="add") {{__('Create New Bill')}} @else{{__('Update Bill')}} @endif<span style="float: right;">LR.NO. {{$lr_number}}</span></div>
      <div class="card-body">

        <form method="post" class="create_bill" action="{{ $action }}">
          @csrf
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <input type="number" class="form-control @error('lrno') is-invalid @enderror" name="lrno" value="{{$lr_number}}">
                <input type="hidden" name="mode" value="{{$mode}}">
                <input type="hidden" name="id" value="{{ $mode == "edit" ? $arrResult->id : 0 }}">
                @error('lrno')
                  <span class="error" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label>Customer Email</label>
                <input class="form-control" type="email" name="royal_email" placeholder="Customer Email" value="{{old('royal_email', !empty($arrResult->royal_email) ? $arrResult->royal_email : null)}}">
              </div>
              <div class="col-md-6">
                <label>Truck No</label>
                <input class="form-control" type="text" name="truckno" placeholder="Truck No" value="{{old('truckno', !empty($arrResult->truckno) ? $arrResult->truckno : null)}}">
              </div>
              <div class="col-md-4">
                <label>Date</label>
                 <input class="form-control" type="text" value="{{old('royal_date', !empty($arrResult->royal_date) ? $arrResult->royal_date : null)}}" name="royal_date" id="datepicker" autocomplete="off">
              </div>
              <div class="col-md-4">
                <label>From</label>
                <input class="form-control" type="text" value="{{old('royal_from', !empty($arrResult->royal_from) ? $arrResult->royal_from : null)}}" name="royal_from" placeholder="From">
              </div>
              <div class="col-md-4">
                <label>To</label>
                <input class="form-control" type="text" value="{{old('royal_to', !empty($arrResult->royal_to) ? $arrResult->royal_to : null)}}" name="royal_to" placeholder="TO">
              </div>
              <div class="col-md-12">
                <label>Driver Details</label>
                <input class="form-control" type="text" value="{{old('driver_details', !empty($arrResult->driver_details) ? $arrResult->driver_details : null)}}" name="driver_details" placeholder="Driver Details">
              </div>
              <div class="col-md-6">
                <label>Consignor</label>
                <input class="form-control getaddress" id="getaddress_consignor" type="text" value="{{old('consignor1', !empty($arrResult->consignor1) ? $arrResult->consignor1 : null)}}" name="consignor1" placeholder="Consignor">
              </div>
              <div class="col-md-6">
                <label>Consignee</label>
                <input class="form-control getaddress" id="getaddress_consignee" type="text" value="{{old('consignee1', !empty($arrResult->consignee1) ? $arrResult->consignee1 : null)}}" name="consignee1" placeholder="Consignee">
              </div>
              <div class="col-md-6">
                <label>Consignor Address (block no, area)</label>
                <input class="form-control consignor_add_1" value="{{old('consignor_add_1', !empty($arrResult->consignor_add_1) ? $arrResult->consignor_add_1 : null)}}" name="consignor_add_1" type="text" placeholder="Consignor Address">
              </div>
              
              <div class="col-md-6">
                <label>Consignee Address (block no, area)</label>
                <input class="form-control consignee_add_1" value="{{old('consignee_add_1', !empty($arrResult->consignee_add_1) ? $arrResult->consignee_add_1 : null)}}" name="consignee_add_1" placeholder="Consignee Address" type="text" >
              </div>
              <div class="col-md-6">
                <label>GSTIN </label>
                <input class="form-control gstin1" type="text" value="{{old('gstin1', !empty($arrResult->gstin1) ? $arrResult->gstin1 : null)}}" name="gstin1" placeholder="GSTIN">
              </div>
              <div class="col-md-6">
                <label>GSTIN </label>
                <input class="form-control gstin2" type="text" value="{{old('gstin2', !empty($arrResult->gstin2) ? $arrResult->gstin2 : null)}}" name="gstin2" placeholder="GSTIN">
              </div>
              <div class="col-md-3">
                <label>No. Of Articals</label>
                <input class="form-control" type="number" value="{{old('no1', !empty($arrResult->no1) ? $arrResult->no1 : null)}}" name="no1" placeholder="No. Of Articals">
              </div>
              <div class="col-md-9">
                <label>Nature of goods said to contain</label>
                <input class="form-control" type="text" value="{{old('nogstc1', !empty($arrResult->nogstc1) ? $arrResult->nogstc1 : null)}}" name="nogstc1" placeholder="Nature of goods said to contain">
              </div>
              <div class="col-md-4">
                <label>Weight Q/Kg</label>
                <input class="form-control" id="weight1" type="text" value="{{old('weight1', !empty($arrResult->weight1) ? $arrResult->weight1 : null)}}" name="weight1" placeholder="Weight Q/Kg" onblur="calculate_bill_amount1();">
              </div>
              <div class="col-md-4">
                <label>Rate Per Ton Rs</label>
                <input class="form-control" id="rate1" type="text" value="{{old('rate1', !empty($arrResult->rate1) ? $arrResult->rate1 : null)}}" name="rate1" placeholder="Rate Per Ton Rs" onblur="calculate_bill_amount1();">
              </div>
              <div class="col-md-4">
                <label>Total Freight To Pay Rs</label>
                <input class="form-control" id="total_freighty_to_opay1" type="text" value="{{old('total_freighty_to_opay1', !empty($arrResult->total_freighty_to_opay1) ? $arrResult->total_freighty_to_opay1 : null)}}" name="total_freighty_to_opay1" placeholder="Total Freight To Pay Rs" onblur="calculate_bill_amount1();" >
              </div>
              <div class="col-md-3">
                <label>Amount <input type="checkbox" id="get_default_total" onclick="amount_bill()"></label>
                <input class="form-control" id="royal_amount" type="text" value="{{old('royal_amount', !empty($arrResult->royal_amount) ? $arrResult->royal_amount : null)}}" name="royal_amount" placeholder="Amount">
              </div>
              <div class="col-md-3">
                <label>CGST (6) % <input type="checkbox" id="get_cdst" onclick="amount_bill()"></label>
                <input class="form-control" id="cdst" type="text" value="{{old('cdst', !empty($arrResult->cdst) ? $arrResult->cdst : null)}}" name="cdst" placeholder="CGST">
              </div>
               <div class="col-md-3">
                <label>SGST (6) % <input type="checkbox" id="get_sgst" onclick="amount_bill()"></label>
                <input class="form-control" id="SGST" type="text" value="{{old('sgst', !empty($arrResult->sgst) ? $arrResult->sgst : null)}}" name="sgst" placeholder="SGST">
              </div>
              <div class="col-md-3">
                <label>Total Amount <input type="checkbox" id="get_total_amount" onclick="amount_bill()"></label>
                <input class="form-control" id="total_amount" type="text" value="{{old('total_amount', !empty($arrResult->total_amount) ? $arrResult->total_amount : null)}}" name="total_amount" placeholder="Total Amount">
              </div>
               <div class="col-md-12">
                <label>Service tax is payable by : </label>
              </div>
              <div class="col-md-2">
                <label><input type="checkbox" name="consignor" placeholder="Enter last name" value="Y" {{ (!empty($arrResult->consignor) && $arrResult->consignor == "Y") ? 'checked' : null }}> Consignor  </label>
               
              </div>
               <div class="col-md-2">
                <label><input type="checkbox" name="consignee" placeholder="Enter last name" value="Y" {{ (!empty($arrResult->consignee) && $arrResult->consignee == "Y") ? 'checked' : null }}> Consignee  </label>
              </div>
              <div class="col-md-2">
                <label><input type="checkbox" name="transport" placeholder="Enter last name" value="Y" {{ (!empty($arrResult->transport) && $arrResult->transport == "Y") ? 'checked' : null }}> Transport </label>
               
              </div>
              <div class="col-md-2">
                <label>
                  <input type="radio" name="ToPayOrPaid"  value="To Pay" {{ (!empty($arrResult->ToPayOrPaid) && $arrResult->ToPayOrPaid == "To Pay") ? 'checked' : null }}> To Pay 
                  <input type="radio" name="ToPayOrPaid"  value="Paid" {{ (!empty($arrResult->ToPayOrPaid) && $arrResult->ToPayOrPaid == "Paid") ? 'checked' : null }}> Paid 
                </label>
               
              </div>

              <div class="col-md-4">
                <label>Unpaid Party : </label>
                <label>
                  <input type="radio" name="UnpaidParty"  value="Consignor" {{ (!empty($arrResult->UnpaidParty) && $arrResult->UnpaidParty == "Consignor") ? 'checked' : null }}> Consignor 
                  <input type="radio" name="UnpaidParty"  value="Consignee" {{ (!empty($arrResult->UnpaidParty) && $arrResult->UnpaidParty == "Consignee") ? 'checked' : null }}> Consignee 
                </label>
               
              </div>
            </div>
          </div>
          <input type="submit" name="sub" class="btn btn-primary btn-block" value="Save & Send" style="width: 40%; margin: 0 auto">
        </form>
      </div>
    </div>
  </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
function calculate_bill_amount1() {
  var weight1 = document.getElementById("weight1").value.trim();
  var rate1 = document.getElementById("rate1").value.trim();

  if(weight1 != '' && !isNaN(weight1) && rate1 != '' && !isNaN(rate1)){
    var amount1 = weight1*rate1;
    document.getElementById("total_freighty_to_opay1").value = amount1.toFixed(2);
  }

}

function amount_bill() {
  var lfckv = document.getElementById("get_default_total").checked;
  var get_cdst = document.getElementById("get_cdst").checked;
  var get_sgst = document.getElementById("get_sgst").checked;
  var get_total_amount = document.getElementById("get_total_amount").checked;
  if(lfckv){
    var a1 = document.getElementById("total_freighty_to_opay1").value.trim();
    
    if(a1 != '' && !isNaN(a1)){
      var amount2 = a1*112/100;
      document.getElementById("royal_amount").value = a1;
      document.getElementById("total_amount").value = amount2.toFixed(2);
    }
  }else{
    document.getElementById("royal_amount").value = '';
  }

  if(get_cdst){
    var a1 = document.getElementById("royal_amount").value.trim();
    
    if(a1 != '' && !isNaN(a1)){
      var amount2 = a1*6/100;
      document.getElementById("cdst").value = amount2.toFixed(2);
    }else{
      alert('Please Select Amount');
    }
    }else{
      
      document.getElementById("cdst").value = '';
    }

  if(get_sgst){
    var a1 = document.getElementById("royal_amount").value.trim();
    
    if(a1 != '' && !isNaN(a1)){
      var amount2 = a1*6/100;
      document.getElementById("SGST").value = amount2.toFixed(2);
    }else{
      alert('Please Select Amount');
    }
  }else{
    document.getElementById("SGST").value = '';
  }

  if(get_total_amount){
    var a1 = document.getElementById("royal_amount").value.trim();
    
    if(a1 != '' && !isNaN(a1)){
      var amount2 = a1*112/100;
      document.getElementById("total_amount").value = amount2.toFixed(2);
    }else{
      alert('Please Select Amount');
    }
  }else{
    document.getElementById("total_amount").value = '';
  }

}
  /*GET  CONSINEE ADDRESS*/

$("#getaddress_consignor").focusout(function(){
  var name = $(this).val().trim();
  var type = 'consignor';
  uploadIframeImage(name,type);
  return false;
});
$("#getaddress_consignee").focusout(function(){
  var name = $(this).val().trim();
  var type = 'consignee';
  uploadIframeImage(name,type);
  return false;
});

function uploadIframeImage(name,type){

  jQuery("#prdmessage").html('<img src="images/logout.gif" alt="Wait..." title="Wait..." >');
  jQuery.ajax({
    url: "{{ url('ajax-search-address') }}",
    type: "POST", 
    data: { name: name, type: type, _token: '{{ csrf_token() }}' },         
    success: function (data) {
      
      var obj = jQuery.parseJSON( data );
      
      if(obj.type =='consignor'){
            $(".consignor_add_1").val('');
            $(".consignor_add_2").val('');
            $(".gstin1").val('');
      }
      if(obj.type =='consignee'){
            $(".consignee_add_1").val('');
            $(".consignee_add_2").val('');
            $(".gstin2").val('');
      }
      if(obj.type =='consignor' && (obj.consignor_add_1 !='' || obj.consignor_add_2 !='') ){
        $(".consignor_add_1").val(obj.consignor_add_1);
        $(".consignor_add_2").val(obj.consignor_add_2);
        $(".gstin1").val(obj.gstin1);
      }else if(obj.type =='consignee' && (obj.consignee_add_1 !='' || obj.consignee_add_2 !='')){
        $(".consignee_add_1").val(obj.consignee_add_1);
        $(".consignee_add_2").val(obj.consignee_add_2);
        $(".gstin2").val(obj.gstin2);
      }else{
        //alert('No Data Found! Please check LR. NO');
      }
      jQuery("#prdmessage").empty();
    }
  });
}
</script>
@endsection