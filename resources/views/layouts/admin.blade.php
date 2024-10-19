@extends('app')
@push('head')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ Vite::asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ Vite::asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content-app')
    <div id="app-layout">
        <!-- Topbar Start -->
        <x-common.headers.admin />
        <!-- end Topbar -->
        <x-common.sidebars.admin />

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            <!-- Footer Start -->
            <x-common.footers.admin />
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
@endsection
@push('footer')
    <!-- Vendor -->
    <script src="{{ Vite::asset('resources/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- Apexcharts JS -->
    <script src="{{ Vite::asset('resources/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- for basic area chart -->
    {{-- <script src="../../../apexcharts.com/samples/assets/stock-prices.js"></script> --}}

    <!-- Widgets Init Js -->
    <script src="{{ Vite::asset('resources/assets/js/pages/analytics-dashboard.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ Vite::asset('resources/assets/js/app.js') }}"></script>
@endpush
