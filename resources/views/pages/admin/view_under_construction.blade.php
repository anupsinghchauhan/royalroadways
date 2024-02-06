@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">{{ __('Dashboard') }}</a>
  </li>
  <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header">{{ $title }}</div>
      <div class="card-body">
        <!-- content -->
      </div>
    </div>
  </div>
</div>
@stop