@extends('layouts.default')
@section('content')
<style type="text/css">
  .bg-daily-trucks{
    background-color: #977db3;
  }
  .bg-payment{
    background-color: #7da7b3;
  }
</style>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">My Dashboard</li>
</ol>
<!-- Icon Cards-->
<div class="row">

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-comments"></i>
        </div>
        <div class="mr-5"> {{ $ArrCount}} Today Bills</div>
      </div>
       <a class="card-footer text-white clearfix small z-1" href="{{URL('lr-bill/today')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5">{{ $ArrAllCount}} All Bills!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('lr-bill')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-plus-square-o"></i>
        </div>
        <div class="mr-5">Create New Bill!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('lr-bill/create-bill')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  {{--
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-secondary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-address-book-o"></i>
        </div>
        <div class="mr-5">Create Bill Info</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('bills/create-bill')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-info o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-address-card"></i>
        </div>
        <div class="mr-5">All Bill Details</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('bills')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-daily-trucks o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-car"></i>
        </div>
        <div class="mr-5">Daily trucks</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('trucks/daily-trucks')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  --}}
   <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-payment o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-pencil-square-o"></i>
        </div>
        <div class="mr-5">Monthly Pending Payment</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('monthly-pending-party-payment-list')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  {{-- 
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-comments"></i>
        </div>
        <div class="mr-5">All Truck Details</div>
      </div>
       <a class="card-footer text-white clearfix small z-1" href="{{URL('trucks')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5">Create New User</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('users/create')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-support"></i>
        </div>
        <div class="mr-5">My Profile</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('users/profile')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  

   <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-secondary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-address-book-o"></i>
        </div>
        <div class="mr-5">Trucks Expance List</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{URL('trucks-vice-expance')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>

  --}}
</div>
@stop