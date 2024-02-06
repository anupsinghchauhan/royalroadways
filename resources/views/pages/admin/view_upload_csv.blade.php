@extends('layouts.default')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('/dashboard')}}">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Upload FILE</li>
</ol>
<!-- Icon Cards-->
<div class="row">
  <div class="col-12">
    <div class="card mx-auto">
      <div class="card-header">Upload File Here</div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" id="csv_form">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <label for="exampleInputName">Choose file to Upload Here *</label>
              </div>
              <div class="col-md-6">
                <input type="file" class="form-control" id="csv_file" name="csv_file" required="">
              </div>
              <div class="col-md-3">
                <input type="submit" name="csv_submit" id="formtrigger" value="Submit" class="btn btn-primary btn-block">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop