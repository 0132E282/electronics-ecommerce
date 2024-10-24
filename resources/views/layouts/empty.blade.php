@extends('app')
@push('head')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/images/favicon.ico') }}">
@endpush
@section('content-app')
    @yield('content')
@endsection
