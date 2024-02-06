@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
   <li class="breadcrumb-item">
      <a href="{{url('/dashboard')}}">{{ __('Dashboard') }}</a>
   </li>
   <li class="breadcrumb-item active">{{ $mode=="edit"?__('Update Bill Info'):__('Create Bill Info') }}</li>
</ol>
<!-- Icon Cards-->
<div class="row">
   <div class="col-12">
      <div class="card mx-auto">
         <div class="card-header">{{ __('Create Bill Info') }}</div>
         <div class="card-body">
            <!-- content -->
            @if ($errors->any())
          <div class="alert alert-danger">
              <ul style="margin: 0;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
            <form action="{{ url('bills/save',$id) }}" method="POST" enctype="multipart/form-data" id="csv_form">
              @csrf
              <input type="hidden" name="mode" value="{{$mode}}">
               <div class="card-body">
                  <div class="table-responsive">
                     <table style="width: 100%; padding-left: 3%; padding-right: 3%;" bgcolor="#3d468a">
                        <tr>
                           <td>
                              <div>
                                 <table style="width: 100%">
                                    <tr>
                                       <td style="width:65% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">Subject to Ahmedabad Jurisdiction</td>
                                       <td style="width:15% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">M. 9909378655</td>
                                       <td style="width:15%;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff"><img src="http://royalroadways.in/assets/images/wassapp.png"> 9824878655</td>
                                    </tr>
                                 </table>
                                 <div style="width: 100%;text-align: center;font-family: Arial, sans-serif;color: #fff"><font style="font-size: 70px;">Royal Roadways</font></div>
                                 <table style="width: 100%">
                                    <tr>
                                       <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;font-size:12px;color: #fff"><font>F<span style="font-size: 11px;">LEET</span> O<span style="font-size: 11px;">WNER</span>, T<span style="font-size: 11px;">RANSPORT</span> C<span style="font-size: 11px;">ONTRCTOR</span> & C<span style="font-size: 11px;">OMMISION</span> A<span style="font-size: 11px;">GENT</span></font></td>
                                    </tr>
                                 </table>
                                 <table style="width: 100%">
                                    <tr>
                                       <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;color: #fff"><font style="font-size: 14px;">A3, Sarkhej Complex, Opp. Sunrise Hotel, Nr. Ujala Circle, Sarkhej-Bavla Road, Sarkhej, Ahmedabad - 382210</font></td>
                                    </tr>
                                 </table>
                              </div>
                           </td>
                        </tr>
                     </table>
                     <table cellpadding="2" cellspacing="2" nobr="true">
                        <tr>
                           <th colspan="3" align="center"></th>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     </table>
                     <div style="width: 100%;border:1px solid #b1b1b1">
                        <div class="form-row" style="padding: 9px;">
                           <div class="col-md-1">
                              <label style="margin-left: 17px;margin-top: 9px;">M/S</label>
                           </div>
                           <div class="col-md-6" >
                              <input type="text" name="c_name1" class="form-control" value="{{old('c_name1',(isset($arrBillData['client_name']))? $arrBillData['client_name'] : '' ) }}">
                           </div>
                           <div class="col-md-2" style="text-align: right">
                              <label style="margin-left: 17px;margin-top: 9px;">Bill No. :</label>
                           </div>
                           <div class="col-md-3">
                              <input type="text" name="bill_no" value="{{$bill_no}}" class="form-control" autocomplete="off" >
                           </div>
                        </div>
                        <div class="form-row" style="padding: 9px;">
                           <div class="col-md-1">
                           </div>
                           <div class="col-md-6" >
                              
                           </div>
                           <div class="col-md-2" style="text-align: right">
                              <label style="margin-left: 17px;margin-top: 9px;">Date :</label>
                           </div>
                           <div class="col-md-3">
                              <input type="text" name="bill_date" id="datepicker" class="form-control" autocomplete="off" value="{{old('bill_date',(isset($arrBillData['bill_date']))? date('d-m-Y',strtotime($arrBillData['bill_date'])) : '' ) }}">
                           </div>
                        </div>
                     </div>
                     <table cellpadding="2" cellspacing="2" nobr="true">
                        <tr>
                           <th colspan="3" align="center"></th>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                     </table>
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>truck No.</th>
                              <th>L.R No.</th>
                              <th>Date</th>
                              <th>Weight</th>
                              <th>Rate</th>
                              <th>Consignor</th>
                              <th>Consignee</th>
                              <th>Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                          @if($mode == "add")
                          @for ($i=1; $i < 21; $i++)
                           <tr>
                              <td><input type="text" class="tr_{{ $i }}" name="trno[]" style="width:110px;"></td>
                              <td><input type="number" class="lrno_{{ $i }}" name="lrno[]" onfocusout="getlrno({{ $i }})" style="width:60px;" autocomplete="off" {{ ($i==1)?'':'' }} ></td>
                              <td><input type="text" class="date_{{ $i }}" name="paid_date[]" style="width:110px;"></td>
                              <td><input type="text" class="weight_{{ $i }}" name="weight[]" style="width:70px;"></td>
                              <td><input type="text" class="rate_{{ $i }}" name="rate[]"></td>
                              <td><input type="text" class="consignor_{{ $i }}" name="consignor[]"></td>
                              <td><input type="text" class="consignee_{{ $i }}" name="consignee[]"> </td>
                              <td><input type="text" class="amt_{{ $i }}" name="amt[]" style="width:100px;"></td>
                           </tr>
                           @endfor
                          @else

                          @php
                            $jsonData = json_decode($arrBillData['bill_information_data']);
                            $j = 1;
                          @endphp
                          @foreach ($jsonData as $key => $value)
                            <tr>
                              <td>
                                <input type="text" class="tr_{{ $j }}" name="trno[]" style="width:110px;" value="{{$value->trno}}"></td>
                              <td>
                                <input type="number" class="lrno_{{ $j }}" name="lrno[]" onfocusout="getlrno({{ $j }})" style="width:60px;" autocomplete="off" {{ ($j==1)?'':'' }} value="{{$value->lrno}}"></td>
                              <td>
                                <input type="text" class="date_{{ $j }}" name="paid_date[]" style="width:110px;" value="{{$value->paid_date}}">
                              </td>
                              <td>
                                <input type="text" class="weight_{{ $j }}" name="weight[]" style="width:70px;" value="{{$value->weight}}">
                              </td>
                              <td>
                                <input type="text" class="rate_{{ $j }}" name="rate[]" value="{{$value->rate}}">
                              </td>
                              <td>
                                <input type="text" class="consignor_{{ $j }}" name="consignor[]" value="{{$value->consignor}}">
                              </td>
                              <td>
                                <input type="text" class="consignee_{{ $j }}" name="consignee[]" value="{{$value->consignee}}"> 
                              </td>
                              <td>
                                <input type="text" class="amt_{{ $j }}" name="amt[]" value="{{$value->amt}}">
                              </td>
                            </tr>
                            @php $j++ @endphp
                            @endforeach
                          @endif
                          
                           <tr>
                              <td colspan="6" text-align="left" style="font-family: Arial, sans-serif;color: #000">
                                 <font style="font-size: 14px;">Rupees :</font>
                                 <input type="text" id="total_amt_words" name="total_amt_words" style="width:80%;" autocomplete="off"  value="{{old('total_amt_words',(isset($arrBillData['total_amount_rupees']))? $arrBillData['total_amount_rupees'] : '' ) }}">
                              </td>
                              <td text-align="left" style="font-family: Arial, sans-serif;color: #000">
                                 <font style="font-size: 14px;"><strong>Total</strong></font>
                              </td>
                              <td><input type="text" id="total_amt" name="total_amt" style="width:100px;" autocomplete="off"  value="{{old('total_amt',(isset($arrBillData['total_amount']))? $arrBillData['total_amount'] : '' ) }}"></td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="form-row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                           <input type="submit" name="sub" id="formtrigger" value="Generate Bill" class="btn btn-primary btn-block">
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                           <button class="btn btn-primary btn-block" onclick="return gettotal()">Generate Total</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <!-- content -->
         </div>
      </div>
   </div>
</div>
@stop

@section('javascript')
<script>
function getlrno(lrnocol){
  var str = $(".lrno_"+lrnocol).val().trim();  
  if(str != ""){
    uploadIframeImage(str,lrnocol);
  }
} 
function gettotal(){
  var totamt = 0;
  for (var i = 1; i < 21; i++) {
    if($(".amt_"+i).val().trim() != ""){
      totamt += parseInt($(".amt_"+i).val().trim());
    }
    
  }
  f_amt = totamt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  $("#total_amt").val(f_amt);
  
  var total_amt_words = numberToEnglish(totamt);
  if(total_amt_words != ""){
    $("#total_amt_words").val(total_amt_words);
  }
  return false;
}
function uploadIframeImage(lrno,lrnocol){
    jQuery("#prdmessage").html('<img src="images/logout.gif" alt="Wait..." title="Wait..." >');
    jQuery.ajax({
        url: "{{ url('bills/ajax-search-data') }}",
        type: "POST", 
        data: {
          lrno: lrno,
          _token : '{{csrf_token()}}'
        },         
        success: function (data) // A function to be called if request succeeds
        {
            //$( "#alltotal" ).focus();
            var obj = jQuery.parseJSON( data );
            
            if(typeof obj.lrno!== "undefined"){
              $(".tr_"+lrnocol).val(obj.truckno);
              $(".date_"+lrnocol).val(obj.created_date);
              $(".weight_"+lrnocol).val(obj.weight1);
              $(".rate_"+lrnocol).val(obj.rate1);
              $(".consignor_"+lrnocol).val(obj.consignor);
              $(".consignee_"+lrnocol).val(obj.consignee);
              $(".amt_"+lrnocol).val(obj.total_amount);
            }else{
              toastr.error('No Data Found! Please check LR. NO');
            }
            jQuery("#prdmessage").empty();
        }
    });
}
function numberToEnglish(n, custom_join_character) {

    var string = n.toString(),
        units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words;

    var and = custom_join_character || 'and';

    /* Is number zero? */
    if (parseInt(string) === 0) {
        return 'zero';
    }

    /* Array of units as words */
    units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    /* Array of tens as words */
    tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    /* Array of scales as words */
    scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion', 'Octillion', 'Nonillion', 'Decillion', 'Undecillion', 'Duodecillion', 'Tredecillion', 'Quatttuor-decillion', 'Quindecillion', 'Sexdecillion', 'Septen-decillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion', 'Centillion'];

    /* Split user arguemnt into 3 digit chunks from right to left */
    start = string.length;
    chunks = [];
    while (start > 0) {
        end = start;
        chunks.push(string.slice((start = Math.max(0, start - 3)), end));
    }

    /* Check if function has enough scale words to be able to stringify the user argument */
    chunksLen = chunks.length;
    if (chunksLen > scales.length) {
        return '';
    }

    /* Stringify each integer in each chunk */
    words = [];
    for (i = 0; i < chunksLen; i++) {

        chunk = parseInt(chunks[i]);

        if (chunk) {

            /* Split chunk into array of individual integers */
            ints = chunks[i].split('').reverse().map(parseFloat);

            /* If tens integer is 1, i.e. 10, then add 10 to units integer */
            if (ints[1] === 1) {
                ints[0] += 10;
            }

            /* Add scale word if chunk is not zero and array item exists */
            if ((word = scales[i])) {
                words.push(word);
            }

            /* Add unit word if array item exists */
            if ((word = units[ints[0]])) {
                words.push(word);
            }

            /* Add tens word if array item exists */
            if ((word = tens[ints[1]])) {
                words.push(word);
            }

            /* Add 'and' string after units or tens integer if: */
            if (ints[0] || ints[1]) {

                /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                if (ints[2] || !i && chunksLen) {
                    words.push(and);
                }

            }

            /* Add hundreds word if array item exists */
            if ((word = units[ints[2]])) {
                words.push(word + ' Hundred');
            }

        }

    }

    return words.reverse().join(' ');

}

<?php if(isset($_GET['billgen']) && $_GET['billgen'] == 'true'){ ?>
 $(window).on('load',function(){
        $('#myModal').modal('show');
    });
<?php } ?>
</script>
@endsection