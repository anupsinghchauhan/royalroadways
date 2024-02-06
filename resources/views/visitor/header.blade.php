<!DOCTYPE html>
<html lang="en"><!--<![endif]-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Royalroadways,Transport Services Ahmedabad, Road Transportation Services in Ahmedabad, Part Load Transport Services in Ahmedabad, Full Load Transport Services in Ahmedabad, Transportation Services Ahmedabad, Daily Parcel Service in Ahmedabad,</title>

<meta name="description" content="Royalroadways provides the best transport services in Ahmedabad. We offer road local and long distance transportation service in Ahmedabad to Rajkot Morbi and All Sourstra.">

<meta name="keywords" content="Royalroadways,Transport Services Ahmedabad, Road Transportation Services in Ahmedabad, Part Load Transport Services in Ahmedabad">
<meta charset="UTF-8">
<meta name="robots" content="index, follow"/>
    <meta name="Language" content="English">
    <meta name="revisit-after" content="1 days" />
    <meta name="resource-type" content="document" />
    <meta property="og:title" content="Royalroadways provides the best transport services in Ahmedabad. We offer road local and long distance transportation service in Ahmedabad to Rajkot Morbi and All Sourstra.">
    <meta property="og:description" content="Royalroadways provides the best transport services in Ahmedabad. We offer road local and long distance transportation service in Ahmedabad to Rajkot Morbi and All Sourstra.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Favicons -->
    <link rel="shortcut icon" href="images/top-icon.png">
    <link rel="apple-touch-icon" href="images/top-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/top-icon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/top-icon.png">
    <style type="text/css">
        #header.header-transparent #navigation .nav > li > a {color: #000;}
    </style>
</head>
<body class="body-header-transparent">
    <!-- #nav-mobile -->
    <nav id="nav-mobile">
        <div class="scrollbar-inner">
            <button type="button" class="navbar-btn-close"><i class="ion ion-close"></i>Close</button>
            <div class="navbar-menu">
              <ul class="nav">
                  <li class="menu-item"><a href="{{url('/')}}" title="Home">Home</a></li>
                    <li class="menu-item"><a href="{{url('/about-us')}}" title="About Us">About Us</a></li>
                    <li class="menu-item"><a href="{{url('/contact-us')}}" title="Contact Us">Contact Us</a></li>
                    <li class="menu-item"><a href="{{url('/truck-list')}}" title="Truck Details">Truck Details</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- #nav-mobile end -->
    <div id="body-wrap">
        <!-- #header -->
        <header id="header" class="header-transparent">
            
            <!-- #nav-mobile-top -->
            <div id="nav-mobile-top">
                
                <!-- .container -->
                <div class="container-fluid">
                    <div class="navmenu">
                        <button type="button" class="navbar-btn-toggle"><i class="ion ion-navicon"></i></button>
                        <div class="navbar-logo">
                           <a href="{{url('/')}}" style="font-family: 'Dancing Script', cursive;font-size: 25px;">Royal <img src="images/royal-logo.png" > Roadways</a>
                        </div>
                    </div>
                </div>
                <!-- .container end -->
            </div>

            <nav id="navigation">
                <!-- .navbar -->
                <div class="navbar">
                    <!-- .container -->
                    <div class="container">
                        <div class="navbar-wrap">
                            <div class="navbar-logo"> <!-- site logo -->
                                <div class="navbar-logo-wrap">
                                    <a href="{{url('/')}}" style="font-family: 'Dancing Script', cursive;font-size: 40px;">
                                        Royal <img src="images/royal-logo.png" style="margin-top: 5px;" > Roadways
                                    </a>
                                </div>
                            </div>
                            <div class="navbar-menu">
                                <ul class="nav">
                                    <li class="menu-item"><a href="{{url('/')}}" title="Home">Home</a></li>
                                    <li class="menu-item"><a href="{{url('/about-us')}}" title="About Us">About Us</a></li>
                                    <li class="menu-item"><a href="{{url('/contact-us')}}" title="Contact Us">Contact Us</a></li>
                                    <li class="menu-item"><a href="{{url('/truck-list')}}" title="Truck Details">Truck Details</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .container end -->
                </div>
            <!-- .navbar end -->
            </nav>
            
            @if(isset($data['is_home']))
            
                <div class="header-content2" data-parallax="scroll" data-speed="0.2" data-natural-width="1920" data-natural-height="1080" data-image-src="images/logistic-truck.jpg" alt="Full load transport services in Ahmedabad" title="Full load transport services in Ahmedabad">
                    <div class="header-content-overlay bg-dark-overlay40">
                        
                        <!-- .container -->
                        <div class="container">
                            
                            <div class="header-content-title">
                                <h3 style="color:white; font-size:42px; font-weight:bold; line-height:55px;">WELCOME TO ROYAL ROADWAYS & ROYAL LOGISTICS</h3>
                               
                            </div>
                            
                            
                        </div>

                        
                    </div>
                </div>
                @else
                <!-- .sub-header -->
                <div class="sub-header">
                    
                    <!-- .container -->
                    <div class="container">
                        
                        <h4 class="header-title">{{$data['page_title']}}</h4>
                        <div class="breadcrumbs">
                            <a href="{{url('/')}}">Home</a> <span class="sep">/</span> <span class="current">{{$data['page_title']}}</span>
                        </div>
                        
                    </div>
                    <!-- .container end -->
                    
                </div>
                <!-- .sub-header end -->
            @endif
        </header>
        <!-- #header end -->