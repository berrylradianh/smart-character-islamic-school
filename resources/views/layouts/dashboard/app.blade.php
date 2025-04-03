<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ $title.' - SCIS' ?? "" }}</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">


    <!--Morris Chart CSS -->
    <link href="{{ asset('dashboard/assets/css/morris.css') }}" rel="stylesheet" >

    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('dashboard/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('dashboard/assets/css/icons.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet" type="text/css" >

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('components.dashboard.navbar')
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('components.dashboard.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/waves.min.js') }}"></script>


    <!--Morris Chart-->
    <script src="{{ asset('dashboard/assets/js/morris.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/raphael.min.js') }}"></script>

    <script src="{{ asset('dashboard/assets/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
    </body>

</html>
