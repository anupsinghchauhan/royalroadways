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
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul style="margin: 0;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <form action="{{ url('bills/send-mail-process',$arrResult->id) }}" method="post">
          @csrf
            <input type="hidden" name="id" value='{{$arrResult->id}} '>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-4">
                  <label>{{ __('Email Address:') }}</label>
                  <input class="form-control" type="text" name="send_email_id" value="{{($arrResult->send_email_id!="")?$arrResult->send_email_id:''}} ">
                </div>
                <div class="col-sm-4">
                  <label></label>
                  <input type="submit" class="btn btn-primary btn-block" name="sub" value="Send Email">
                </div>
                <div class="col-sm-4">
                  <label></label>
                  <a href="{{ url('bills') }}" class="btn btn-primary btn-block">{{ __('Create New Bill') }}</a>
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