<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="{{url('/dashboard')}}">{{theSiteName()}}</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{url('/dashboard')}}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-edit"></i>
          <span class="nav-link-text">LR. Data</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="{{url('lr-bill')}}">All L.R. Bill</a>
          </li>
          <li>
            <a href="{{url('lr-bill/create-bill')}}">Create LR Bill</a>
          </li>
        </ul>
      </li>
      {{--
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents_2" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-credit-card"></i>
          <span class="nav-link-text">Billing</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents_2">
          <li>
            <a href="{{url('bills')}}">All Bill Details</a>
          </li>
          <li>
            <a href="{{url('bills/create-bill')}}">Create Bill Info</a>
          </li>
        </ul>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents_3" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-truck"></i>
          <span class="nav-link-text">Trucks Details</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents_3">
          <li>
            <a href="{{url('trucks')}}">All Truck Details</a>
          </li>
          <li>
            <a href="{{url('trucks/daily-trucks')}}">Daily trucks</a>
          </li>
          <li>
            <a href="{{url('trucks/trucks-vice-expance')}}">Truck Vice Expance Details</a>
          </li>

        </ul>
      </li>
      --}}
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="{{url('upload-csv')}}">
          <i class="fa fa-fw fa-cloud-upload"></i>
          <span class="nav-link-text">Upload CSV</span>
        </a>
      </li>
      <?php /* ?>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="{{url('users')}}">
          <i class="fa fa-fw fa-users"></i>
          <span class="nav-link-text">User</span>
        </a>
      </li>
      <?php */ ?>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="{{url('monthly-pending-party-payment-list')}}">
          <i class="fa fa-fw fa-inr"></i>
          <span class="nav-link-text">Monthly Pending Payment</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li> <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a> 
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
      </li>
    </ul>
  </div>
</nav>