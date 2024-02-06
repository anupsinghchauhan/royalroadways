@extends('layouts.visitor-default')
@section('content')
<!-- #content -->
  <div id="content">
      
      <!-- .container -->
      <div class="container padding-top80 padding-bottom40">
          
         
          
          <!-- .row -->
          <div class="row">
            <?php /*$Arrtruck = all_truck_arr(); ?>
            <?php foreach ($Arrtruck as $key => $value) { ?>
              <div class="col-sm-3"> <!-- 1 -->
                  <div class="affa-post">
                      <figure class="post-thumbnail post-item-thumbnail img-hover2">
                              <a href="javascript:void(0);" onClick ="showLogin('<?php echo $key; ?>')" class="btn-custom btn-border"><?php echo $value; ?></a>
                      </figure>
                  </div>
              </div>
            <?php } */ ?>

          </div>
          <!-- .row end -->                
          
      </div>
      <!-- .container end -->
      
  </div>
  <!-- #content end -->
   <!-- model -->
<div class="modal fade" id="user-login" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <!-- login -->
        <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
            <div class="card-body">
              <form onsubmit="return login12();" method="post" name="loginval">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name</label>
                  <input class="form-control" name="uname" type="text" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" name="pass" type="password" placeholder="Password">
                  <input name="truck_no" id="truck_no" type="hidden" value="">
                </div>
                <div class="col-sm-6 col-sm-offset-1 col-md-offset-3"><input type="submit" class="btn btn-primary btn-block" name="login" value="Login"></div>
                
              </form>
            </div>
          </div>
          </div>
        <!-- login -->
      </div>
    </div>
    
  </div>
</div>
<!-- model -->
@stop
