@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">All Billing Details</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header">
          <i class="fa fa-table"></i> Bill.NO :<b>{{ $arrayPDF['bill_no'] }}</b> Created Date :<b>{{ date('d-m-Y' , strtotime($arrayPDF['created_at']))}}</b> &nbsp;&nbsp;&nbsp;&nbsp;Email :<b>{{ $arrayPDF['send_email_id'] }}</b><a href="{{url('bills/download-pdf',$arrayPDF['id'])}}" class="btn btn-primary" style="margin-left: 10px;">Download PDF</a><input type="button" class="btn btn-primary" style="float: right;" onclick="printDiv('printableArea')" value="Print Bill" /></div>
        <div class="card-body">
          <div id="printableArea" style="background-color: #fff">          
            <!-- content -->
            @include('pages.admin.billing.view_bills_pdf_data')
            <!-- content -->
          </div>
      </div>
    </div>
  </div>
</div>
@stop