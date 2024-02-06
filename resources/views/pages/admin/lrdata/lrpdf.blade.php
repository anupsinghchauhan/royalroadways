<!DOCTYPE html>
<html>
   <head>
      <title></title>
   </head>
   <body>
      <div style="width: 100%">
         <div>
            <table style="width: 100%; padding-left: 3%; padding-right: 3%;" bgcolor="{{getBgColor()}}">
               <tbody>
                  <tr>
                     <td>
                        <div>
                           <table style="width: 100%">
                              <tbody>
                                 <tr>
                                    {{thePDFHeader()}}
                                 </tr>
                              </tbody>
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
                              <tbody>
                                 <tr>
                                    <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;font-size:12px;color: #fff"><font>F<span style="font-size: 11px;">LEET</span> O<span style="font-size: 11px;">WNER</span>, T<span style="font-size: 11px;">RANSPORT</span> C<span style="font-size: 11px;">ONTRCTOR</span> &amp; C<span style="font-size: 11px;">OMMISION</span> A<span style="font-size: 11px;">GENT</span></font></td>
                                 </tr>
                              </tbody>
                           </table>
                           <table style="width: 100%">
                              <tbody>
                                 <tr>
                                    <td style="width:100% ;text-align: center;font-family: Arial, sans-serif;color: #fff"><font style="font-size: 14px;">{{theSiteAddress()}}</font></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
            <table cellpadding="2" cellspacing="2" nobr="true">
               <tbody>
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
               </tbody>
            </table>
            <table style="width: 100%; padding-left: 3%; padding-right: 3%; padding-bottom: 3%;" bgcolor="#ffffff">
               <tbody>
                  <tr>
                     <td style="text-align: left; font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b" colspan="2">{{theBankDetails()}}</td>
                  </tr>
                  <tr>
                     <td style="text-align: left;float: left;font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b">IFSC Code : UTIB0003269
                     </td>
                     <td style="text-align:right;font-size:14px;">L.R.NO : {{$lrno}}</td>
                  </tr>
                  <tr>
                     <td style="font-size:14px;" colspan="2">Branch : Sarkhej &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{theGSTIN()}}</strong>
                     </td>
                  </tr>
               </tbody>
            </table>
            <table cellpadding="2" cellspacing="2" nobr="true">
               <tbody>
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
               </tbody>
            </table>
            <table style="width: 100%">
               <tbody>
                  <tr style="border:1px solid #000;">
                     <td height="15" style="border-top:1px solid #000;border-left:1px solid #000;text-align: left;font-family: Arial, sans-serif;font-size:14px;color:#2b2b2b">
                        <b>Truck No. :</b> {{$truckno}}
                     </td>
                     <td height="15" style="border-top:1px solid #000;border-right:1px solid #000;text-align: left; font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b"><b>Date :</b> {{$royal_date}}</td>
                  </tr>
                  <tr>
                     <td height="15" style="border-top:1px solid #000;border-left:1px solid #000;text-align: left;font-family: Arial, sans-serif;font-size:14px;color:#2b2b2b">
                        <b>From :</b> {{$royal_from}}
                     </td>
                     <td height="15" style="border-top:1px solid #000;border-right:1px solid #000;text-align: left; font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b">
                        <b>To :</b> {{$royal_to}}
                     </td>
                  </tr>
                  <tr>
                     <td height="15" style="border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;text-align: left;font-family: Arial, sans-serif;font-size:14px;color:#2b2b2b" colspan="2">
                        <b>Driver Details : </b>{{$driver_details}}
                     </td>
                  </tr>
               </tbody>
            </table>
            <table cellspacing="0" cellpadding="1" border="1" style="width: 100%">
               <tbody>
                  <tr>
                     <td style="border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;text-align: left; font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b">
                        <b>Consignor :</b> {{$consignor1}}
                        @if($consignor_address!='') <br/><b>Address : </b> {{$consignor_address}} @endif
                        @if($consignor_gstn!='') <br/><b>GSTIN : </b> {{$consignor_gstn}} @endif
                     </td>
                     <td style="border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;text-align: left; font-family: Arial, sans-serif;font-size:14px;line-height:22px; color:#2b2b2b">
                        <b>Consignee :</b> {{$consignee1}}
                        @if($consignee_address!='') <br/><b>Address : </b> {{$consignee_address}} @endif
                        @if($consignee_gstn!='') <br/><b>GSTIN : </b> {{$consignee_gstn}} @endif
                     </td>
                  </tr>
               </tbody>
            </table>
            <table cellpadding="2" cellspacing="2" nobr="true">
               <tbody>
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
               </tbody>
            </table>
            <table cellspacing="0" cellpadding="1" border="1" style="width: 100%">
               <tbody>
                  <tr>
                     <td style="width:5%;font-family: Arial, sans-serif;font-size:12px;text-align: center; color: #fff;" bgcolor="{{getBgColor()}}">No.</td>
                     <td style="width:45%;font-family: Arial, sans-serif;font-size:12px;text-align:center;color: #fff;border-left: 2px solid #fff;" bgcolor="{{getBgColor()}}"> Nature of goods said to contain</td>
                     <td style="width:20%;font-family: Arial, sans-serif;font-size:12px;text-align:center;color: #fff;border-left: 2px solid #fff;" bgcolor="{{getBgColor()}}"> Weight<br>Q/Kg</td>
                     <td style="width:15%;font-family: Arial, sans-serif;font-size:12px;text-align:center;color: #fff;border-left: 2px solid #fff;" bgcolor="{{getBgColor()}}"> Rate Per Ton<br>Rs</td>
                     <td style="width:15%;font-family: Arial, sans-serif;font-size:10px;text-align:center;color: #fff;border-left: 2px solid #fff;" bgcolor="{{getBgColor()}}"> Total Freight To Pay</td>
                  </tr>
                  <tr>
                     <td rowspan="5" style="vertical-align: top;font-family: Arial, sans-serif;font-size:12px;border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;" height="200">
                        {{$no_1}}
                     </td>
                     <td rowspan="5" style="vertical-align: top;font-family: Arial, sans-serif;font-size:12px;border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;" height="200">
                        {{$nogstc1}}
                     </td>
                     <td rowspan="4" style="vertical-align: top;font-family: Arial, sans-serif;font-size:12px;border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;" height="200">
                        {{$weight1}}
                     </td>
                     <td style="vertical-align: top;font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-left: 1px solid #000;" height="100">
                        {{$rate1}}
                     </td>
                     <td style="vertical-align: top;font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;">
                        {{$total_freighty_to_opay1}}
                     </td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;border-top: 1px solid #fff;border-left: 1px solid #000;color: #fff" bgcolor="{{getBgColor()}}">
                        <b><br> Amount<br></b>
                     </td>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;"><b><br>&nbsp;&nbsp;&nbsp;&nbsp;{{$royal_amount}}<br></b>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 2px solid #fff;border-left: 1px solid #000;color: #fff" bgcolor="{{getBgColor()}}"><b><br>CGST(6%)<br></b>
                     </td>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;">
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;{{$cdst}}<br>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 2px solid #fff;border-left: 1px solid #000;color: #fff" bgcolor="{{getBgColor()}}"><b><br>SGST(6%)<br></b>
                     </td>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;">
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;{{$sgst}}<br>
                     </td>
                  </tr>
                  <tr>
                     <td style="text-align: center;font-family: Arial, sans-serif;font-size:13px;border-top: 2px solid #fff;border-left: 1px solid #000;"><b><br/>  &nbsp;&nbsp;&nbsp;&nbsp;{{$ToPayOrPaid}}<br/></b>
                     </td>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 2px solid #fff;border-left: 1px solid #000;color: #fff" bgcolor="{{getBgColor()}}"><b><br>Total<br></b>
                     </td>
                     <td style="font-family: Arial, sans-serif;font-size:12px;border-top: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;">
                        <b><br>&nbsp;&nbsp;&nbsp;&nbsp;{{$total_amount}}<br></b>
                     </td>
                  </tr>
               </tbody>
            </table>
            <table cellpadding="2" cellspacing="2" nobr="true">
               <tbody>
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
               </tbody>
            </table>
            <table bgcolor="#ffffff" style="width: 100%">
               <tbody>
                  <tr>
                     <td style="vertical-align: middle;border: 1px solid {{getBgColor()}}; padding: 3px; float: left;font-family: Arial, sans-serif;font-size:10px;width: 65%"> <b>Service tax is payable by : </b> {{$con1}}&nbsp;&nbsp;&nbsp;{{$conee1}} &nbsp;&nbsp;&nbsp;{{$trans1}}</td>
                     <td style="padding: 3px; width: 30%; float: right;font-family: Arial, sans-serif;font-size:10px;"><font style="font-family: monospace;font-size:17px;font-weight: 600;">For {{ theSiteName() }}</font></td>
                  </tr>
                  <tr>
                     <td style=" padding: 3px; float: left;font-family: Arial, sans-serif;font-size:10px;width: 70%"><b>We are not responsible any breakages of goods,<br>no deduct lorry fright, please <strong> TAKE INSURANCE</strong> of your goods,</b><br><br><br>(1) Driver Copy-white (2) Consignee-Pink (3) Consignor-Yellow (4) Account Copy - Blue
                     </td>
                     <td style="padding: 3px; width: 30% float: left;font-family: Arial, sans-serif;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{SIGNATURE}}" width="100px" height="70px"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proprietor</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>