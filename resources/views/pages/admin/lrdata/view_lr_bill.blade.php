@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">{{ __('View Bill Detail') }}</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header">
          <i class="fa fa-table"></i>&nbsp;&nbsp;{{ __('LR.NO:') }} <b>{{$arrResult->lrno}}</b>&nbsp;&nbsp;{{ __('Created Date:') }} <b>{{$arrResult->royal_date}}</b>&nbsp;&nbsp;{{ __('Email:') }} <b>{{$arrResult->royal_email}}</b><a href="{{URL('lr-bill/download-pdf',$arrResult->id)}}" class="btn btn-primary" style="margin-left: 10px;">{{ __('Download PDF') }}</a><input type="button" class="btn btn-primary" style="float: right;" onclick="printDiv('printableArea')" value="Print Bill"></div>
        <div class="card-body">
        <!-- content -->
        <div id="printableArea" style="background-color: #fff">
          @if($arrResult->pdf_file!='')
          {!! $arrResult->pdf_file !!}
          @else
          @include('pages.admin.lrdata.lrpdf')
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop