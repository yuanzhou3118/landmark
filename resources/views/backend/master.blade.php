<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title> @yield('title') </title>

    <!--icheck-->
    <link href="{{URL::asset('assets/backend/js/iCheck/skins/minimal/minimal.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/backend/js/iCheck/skins/square/square.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/backend/js/iCheck/skins/square/red.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/backend/js/iCheck/skins/square/blue.css')}}" rel="stylesheet">

    <!--dashboard calendar-->
    <link href="{{URL::asset('assets/backend/css/clndr.css')}}" rel="stylesheet">

    <!--Morris Chart CSS -->
    {{--<link rel="stylesheet" href="{{URL::asset('assets/backend/js/morris-chart/morris.css')}}">--}}
    @yield('css')
    <!--common-->
    <link href="{{URL::asset('assets/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/backend/css/style-responsive.css')}}" rel="stylesheet">

    @yield('header_js')
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo" style="top: 8px">
            <a href="{{URL::route('admin.dashboard')}}"><img src="{{URL::asset('assets/backend/images/login-logo.png')}}" alt="" width="85%"></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="{{URL::asset('assets/backend/images/photos/user-avatar.png')}}" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">@yield('username')</a></h4>
                        <span>"Hello!"</span>
                    </div>
                </div>

                {{--<h5 class="left-nav-title">Account Information</h5>--}}
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="{{URL::route('admin.restaurant.query')}}"><i class="fa fa-user"></i> <span>F&B</span></a></li>
                    <li><a href="{{URL::route('admin.user.query')}}"><i class="fa fa-user"></i> <span>User Management</span></a></li>
                    <li><a href="{{URL::route('admin.notification.query')}}"><i class="fa fa-cog"></i> <span>Notification</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <span>PS</span></a></li>
                    <li><a href="{{URL::route('admin.calendar.daily')}}"><i class="fa fa-cog"></i> <span>Room</span></a></li>
                    <li><a href="{{URL::route('admin.booking.query')}}"><i class="fa fa-cog"></i> <span>Booking</span></a></li>
                    <li><a href="{{URL::route('admin.wish.query')}}"><i class="fa fa-cog"></i> <span>Wishlist</span></a></li>
                    <li><a href="{{URL::route('admin.logout')}}"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="{{URL::route('admin.dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                {{--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>Layouts</span></a>--}}
                    {{--<ul class="sub-menu-list">--}}
                        {{--<li><a href="blank_page.html"> Blank Page</a></li>--}}
                        {{--<li><a href="boxed_view.html"> Boxed Page</a></li>--}}
                        {{--<li><a href="leftmenu_collapsed_view.html"> Sidebar Collapsed</a></li>--}}
                        {{--<li><a href="horizontal_menu.html"> Horizontal Menu</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="{{URL::route('admin.login')}}"><i class="fa fa-sign-in"></i> <span>Login Page</span></a></li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >
        @yield('heading')
        <!-- header section start-->
        {{--<div class="header-section" style="z-index: 9999">--}}

            {{--<!--toggle button start-->--}}
            {{--<a class="toggle-btn"><i class="fa fa-bars"></i></a>--}}
            {{--<!--toggle button end-->--}}

            {{--<!--search start-->--}}
            {{--<form class="searchform" action="index.html" method="post">--}}
                {{--<input type="text" class="form-control" name="keyword" placeholder="Search here..." />--}}
            {{--</form>--}}
            {{--<!--search end-->--}}

        {{--</div>--}}
        <!-- header section end-->

        <!-- page heading start-->

        <!-- page heading end-->

        <!--body wrapper start-->
        @yield('content')
        <!--body wrapper end-->

        <!--footer section start-->
        <footer class="sticky-footer">
            2016 &copy; Landmark by Sophia
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{URL::asset('assets/backend/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/modernizr.min.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/jquery.nicescroll.js')}}"></script>

<!--easy pie chart-->
<script src="{{URL::asset('assets/backend/js/easypiechart/jquery.easypiechart.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/easypiechart/easypiechart-init.js')}}"></script>

<!--Sparkline Chart-->
<script src="{{URL::asset('assets/backend/js/sparkline/jquery.sparkline.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/sparkline/sparkline-init.js')}}"></script>

<!--icheck -->
<script src="{{URL::asset('assets/backend/js/iCheck/jquery.icheck.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/icheck-init.js')}}"></script>

<!-- jQuery Flot Chart-->
<script src="{{URL::asset('assets/backend/js/flot-chart/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/flot-chart/jquery.flot.tooltip.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/flot-chart/jquery.flot.resize.js')}}"></script>


<!--Morris Chart-->
{{--<script src="{{URL::asset('assets/backend/js/morris-chart/morris.js')}}"></script>--}}
{{--<script src="{{URL::asset('assets/backend/js/morris-chart/raphael-min.js')}}"></script>--}}

<!--Calendar-->
<script src="{{URL::asset('assets/backend/js/calendar/clndr.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/calendar/evnt.calendar.init.js')}}"></script>
<script src="{{URL::asset('assets/backend/js/calendar/moment-2.2.1.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="{{URL::asset('assets/backend/js/scripts.js')}}"></script>

<!--Dashboard Charts-->
{{--<script src="{{URL::asset('assets/backend/js/dashboard-chart-init.js')}}"></script>--}}

@yield('script')
</body>
</html>
