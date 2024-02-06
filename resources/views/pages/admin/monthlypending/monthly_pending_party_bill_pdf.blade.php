<style>.ctmtable { border: 1px solid grey; } .red{color: red;} .green{color:green;} </style>

<div style="width: 100%">
   <div>
      <table style="width: 100%; padding-left: 3%; padding-right: 3%;" bgcolor="{{getBgColor()}}">
         <tr>
            <td>
               <div>
                  <table style="width: 100%">
                     <tr>
                        {{thePDFHeader()}}
                     </tr>
                  </table>
                  <table style="width: 100%;">
                     <tbody>
                        <tr>
                           <td style="text-align: center;font-family: Arial, sans-serif;color: #fff">
                           <font style="font-size: 70px;">
                           {{theSiteName()}}
                           </td>
                        </font>
                        </tr>
                     </tbody>
                  </table>
                  
                  <table style="width: 100%">
                     <tr>
                        <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;font-size:12px;color: #fff"><font>F<span style="font-size: 11px;">LEET</span> O<span style="font-size: 11px;">WNER</span>, T<span style="font-size: 11px;">RANSPORT</span> C<span style="font-size: 11px;">ONTRCTOR</span> & C<span style="font-size: 11px;">OMMISION</span> A<span style="font-size: 11px;">GENT</span></font></td>
                     </tr>
                  </table>
                  <table style="width: 100%">
                     <tr>
                        <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;color: #fff"><font style="font-size: 14px;">{{theSiteAddress()}}</font></td>
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
            <td colspan="{{ ($mode == 'view') ? 10 : 9}}" class="ctmtable" style="width: 100%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Party Name: </strong>{{ ucfirst( $party_name ) }}  {{$date_range}}</td>
         </tr>
         <tr>
            <td class="ctmtable" style="width: 5%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Sr No.</strong></td>
            <td class="ctmtable" style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Truck No.</strong></td>
            <td class="ctmtable" style="width: 9%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>L.R No.</strong></td>
            <td class="ctmtable" style="width: 12%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Date</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Weight</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Rate</strong></td>
            <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Consignee</strong></td>
            <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Consignor</strong></td>
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Amount (Rs.)</strong></td>
            @if($mode == "view")
            <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:8px;"><strong>Action</strong></td>
            @endif
         </tr>
         @php
            $p=1;
            $total_amt = $total_paid_amt = 0; 
          @endphp
            @foreach($arrResult as $row)
          @php
            $total_amt += ($row['total_amount']!="")?(int)$row['total_amount']:0;
            $total_paid_amt += ($row['total_paid_amount']!="")?(int)$row['total_paid_amount']:0;
          @endphp
            <tr>
               <td class="ctmtable" style="width: 5%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{$p}}</td>
               <td class="ctmtable" style="width: 10%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{strtoupper($row['truckno'])}}</td>
               <td class="ctmtable" style="width: 9%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{$row['lrno']}}</td>
               <td class="ctmtable" style="width: 12%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{getDateFormate($row['royal_date'])}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{$row['weight1']}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{$row['rate1']}}</td>
               <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{strtoupper($row['consignee1'])}}</td>
               <td class="ctmtable" style="width: 20%;font-family: Arial, sans-serif;color: #000;font-size:7px;">{{ strtoupper($row['consignor1'])}}</td>
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;font-size:7px;"><span class="red">{{number_format( ($row['total_amount']!="")?(int)$row['total_amount']:0 )}}</span> <br /><span class="green">{{ number_format(  ($row['total_paid_amount']!="")?(int)$row['total_paid_amount']:0 )}}</span></td>
               @if($mode == "view")
               <td class="ctmtable" style="width: 8%;font-family: Arial, sans-serif;color: #000;">
                  <a href="javascript:void(0);" onclick="DeleteLRData('{{URL('monthly-pending-party-bill/delete',$row['pending_paymet_party_id'])}}');">
                     <i class="fa fa-trash" aria-hidden="true"></i></a>
                     <a href="javascript:void(0);" onclick="UpdatePayment('{{ $row['pending_paymet_party_id'] }}','{{$row['consignee1']}}','{{ $row['consignor1'] }}');">
                     <i class="fa fa-edit" aria-hidden="true"></i></a>
               </td>
               @endif
            </tr>
            @php $p++; @endphp
         @endforeach
         <tr>
            <td  class="ctmtable" colspan="7" text-align="left" style="font-family: Arial, sans-serif;color: #000">
               <font style="font-size: 12px;"><strong>Rupees :  </strong></font>
               <font style="font-size: 10px;padding-top:20%">{{ getIndianCurrency($total_amt) }}</font>
            </td>
            <td  class="ctmtable" text-align="left" style="font-family: Arial, sans-serif;color: #000">
               <font style="font-size: 12px;"><strong>Pending Total (Rs.)<hr /> Received Amount (Rs.)</strong></font>
            </td>
            <td colspan="{{ ($mode == 'view') ? 2 : ''}}" class="ctmtable" style="font-family: Arial, sans-serif;color: #000;font-size:10px;">
               <span class="red">{{ number_format( $total_amt , 2) }}</span><hr /> 
               <span class="green">{{number_format($total_paid_amt,2) }}</span>
            </td>
         </tr>
      </table>
      <table cellpadding="2" cellspacing="2" nobr="true" width="100%">
         <tr>
            <th colspan="3" align="center"></th>
         </tr>
         <tr>
            <td style="width: 5%;height:25px"></td>
            <td style="width: 10%;height:25px"></td>
            <td style="width: 10%;height:25px"></td>
            <td style="width: 15%;height:25px"></td>
            <td style="width: 15%;height:25px"></td>
            <td style="width: 15%;height:25px"></td>
            <td style="width: 5%;height:25px"></td>
            <td style="width: 15%;height:25px"></td>
            <td style="width: 10%;height:25px"></td>
         </tr>
         
         <tr>
            <td colspan="7"></td>
            <td colspan="2" style="font-family: Arial, sans-serif;color: #000">
            <img src="{{SIGNATURE}}" width="100px" height="70px" />
            <font style="font-size:10px;color:#000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proprietor</font></td>
         </tr>
      </table>
   </div>
</div>