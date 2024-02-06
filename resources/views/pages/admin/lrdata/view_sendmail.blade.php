@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">{{ __('Send Mail To') }}</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header">{{ __('Send Email') }} </div>
      <div class="card-body">
        <!-- content -->
        <form action="{{ url('lr-bill/send-mail-process',$arrResult->id) }}" method="post">
          @csrf
            <input type="hidden" name="pdf_attacment" value='{{$arrResult->pdf_name}} '>
            <input type="hidden" name="id" value='{{$arrResult->id}} '>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-4">
                  <label>{{ __('Send Email To') }}</label>
                  <input class="form-control" type="text" name="royal_email" value="{{$arrResult->royal_email}} ">
                </div>
                <div class="col-sm-4">
                  <label></label>
                  <input type="submit" class="btn btn-primary btn-block" name="sub" value="Send Email">
                </div>
                <div class="col-sm-4">
                  <label></label>
                  <a href="{{ url('lr-bill/create-bill') }}" class="btn btn-primary btn-block">{{ __('Create New Bill') }}</a>
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