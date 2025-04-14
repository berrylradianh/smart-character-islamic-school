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

    <link rel="manifest" href="{{ asset('manifest_dashboard.json') }}">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Morris Chart CSS -->
    <link href="{{ asset('dashboard/assets/css/morris.css') }}" rel="stylesheet">

    <!-- CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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


    @yield('scripts')
    @vite(['resources/js/app.js'])
</body>

</html>
