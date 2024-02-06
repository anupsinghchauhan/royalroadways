<style>
.ctmtable {
   border: 1px solid grey;
}
</style>
<div style="width: 100%">
   <div>
      <table style="width: 100%; padding-left: 3%; padding-right: 3%;" bgcolor="#3d468a">
         <tr>
            <td>
               <div>
                  <table style="width: 100%">
                     <tr>
                        <td style="width:65% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">Subject to Ahmedabad Jurisdiction</td>
                        <td style="width:15% ;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff">M. 9909378655</td>
                        <td style="width:15%;text-align: right;font-family: Arial, sans-serif;font-size:12px;color: #fff"><img src="{{WHATSAPP_IMAGE}}"> 9824878655</td>
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
      </table>
      <div style="width: 100%;border:1px solid #b1b1b1">
        <table style="width: 100%" cellpadding="2" cellspacing="5">          
          <tr>
            <td style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:12px;"><strong> M/S </strong></td>
            <td style="width: 65%;text-align: left;font-family: Arial, sans-serif;color: #000;font-size:12px;">{{$arrayPDF['client_name']}}</td>
            <td style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:12px;"><strong>Bill No. :</strong></td>
            <td style="width: 15%;text-align: left;font-family: Arial, sans-serif;color: #000;font-size:12px;">{{$arrayPDF['bill_no']}}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td style="font-family: Arial, sans-serif;color: #000;font-size:12px;padding-bottom: 20px;"><strong>Date :</strong></td>
            <td style="text-align: left;font-family: Arial, sans-serif;color: #000;font-size:12px;padding-bottom: 20px;">{{$arrayPDF['bill_date']}}</td>
          </tr>
          
        </table>
         
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
      <table cellspacing="0" cellpadding="7" width="100%">      
         <tr>
            <td class="ctmtable" style="width: 5%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Sr No.</strong></td>
            <td class="ctmtable" style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Truck No.</strong></td>
            <td class="ctmtable" style="width: 9%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>L.R No.</strong></td>
            <td class="ctmtable" style="width: 12%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Date</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Weight</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Rate</strong></td>
            <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Consignee</strong></td>
            <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Consignor</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Amount</strong></td>
         </tr>
         @php
            $jsonData = json_decode($arrayPDF['bill_information_data']);
            $j = 1;
         @endphp
         @foreach ($jsonData as $key => $value)
            <tr>
               <td class="ctmtable" style="width: 5%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{$j}}</td>
               <td class="ctmtable" style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->trno}}</td>
               <td class="ctmtable" style="width: 9%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->lrno}}</td>
               <td class="ctmtable" style="width: 12%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{getDateFormate($value->paid_date)}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->weight}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->rate}}</td>
               <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->consignee}}</td>
               <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->consignor}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:7px;">
                  {{$value->amt}}</td>
            </tr>
            @php $j++ @endphp
            @endforeach
            <tr>
               <td  class="ctmtable" colspan="7" text-align="left" style="font-family: Arial, sans-serif;color: #000">
                  <font style="font-size: 12px;">Rupees :  </font><font style="font-size: 10px;padding-top:20%">{{$arrayPDF['total_amount_rupees']}}</font>
               </td>
               <td  class="ctmtable" text-align="left" style="font-family: Arial, sans-serif;color: #000">
                  <font style="font-size: 12px;"><strong>Total</strong></font>
               </td>
               <td class="ctmtable" style="font-family: Arial, sans-serif;color: #000;font-size:10px;">{{$arrayPDF['total_amount']}}</td>
            </tr>
      </table>
      <table cellpadding="2" cellspacing="2" nobr="true" width="100%">
         <tr>
            <th colspan="3" align="center"></th>
         </tr>
         <tr>
           <td style="width: 5%;height:25px"></td>
            <td style="width: 10%;height:25px"></td>
            <td style="width: 9%;height:25px"></td>
            <td style="width: 12%;height:25px"></td>
            <td style="width: 8%;height:25px"></td>
            <td style="width: 8%;height:25px"></td>
            <td style="width: 8%;height:25px"></td>
            <td style="width: 20%;height:25px"></td>
            <td style="width: 8%;height:25px"></td>
         </tr>
         
         <tr>
            <td colspan="7"></td>
            <td colspan="2" style="font-family: Arial, sans-serif;color: #000"><img src="{{SIGNATURE}}" width="100px" height="70px">
<font style="font-size:10px;color:#000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proprietor</font></td>
         </tr>
      </table>
   </div>
</div>