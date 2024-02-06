<div class="sticky-header header-section ">
    <div class="header-left">
        <!--toggle button start-->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <div class="clearfix"> </div>
    </div>
    <div class="header-right">
        
        <div class="profile_details">       
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">   
                            <span class="prfil-img"><img src="{{ URL::asset('admin/images/2.jpg')}}" alt=""> </span> 
                            <div class="user-name">
                                <p>{{ Auth::user()->name }}</p>
                                <span>Administrator</span>
                            </div>
                            <i class="fa fa-angle-down lnr"></i>
                            <i class="fa fa-angle-up lnr"></i>
                            <div class="clearfix"></div>    
                        </div>  
                    </a>
                    <ul class="dropdown-menu drp-mnu">
                        <li> <a href="{{ url('profile') }}" ><i class="fa fa-user"></i> My Account</a> </li>
                        <li> <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out"></i> Logout</a> </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>               
    </div>
    <div class="clearfix"> </div>   
</div>