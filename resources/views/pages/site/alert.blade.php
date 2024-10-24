@extends('layouts.empty')
@push('head')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/images/favicon.ico') }}">
@endpush

@section('content')
    <div class="mx-auto card" style="max-width: 400px; margin-top: 5%;">
        <div class="card-header bg-transparent p-4 border-0 d-flex pb-2">
            <div class="mx-auto">
                @switch($type)
                    @case('success')
                        <span class="rounded-circle p-3 d-inline-flex bg-success">
                            <i class="m-auto text-white" style="width: 40px; height: 40px;" data-feather="check"></i>
                        </span>
                    @break

                    @case('error')
                        <div class="rounded-circle p-3 d-flex bg-danger mx-auto">
                            <i class="m-auto text-white" style="width: 40px; height: 40px;" data-feather="alert-triangle"></i>
                        </div>
                    @break

                    @default
                @endswitch
            </div>
        </div>
        <div class="card-body text-center pt-0 pb-4">
            <p>{{ session('message.content') ?? ($type === 'success' ? 'Yêu cầu thành công' : 'Có lỗi xây ra') }}</p>
            <a href="{{ session('message.redirect_url') }}" class="link-primary py-1">Trang quản lý</a>
            <a href="{{ url()->previous() }}" class="link-primary py-1 ms-3">Quay lại</a>
        </div>
    </div>
@endsection
@push('body-js')
    <!-- Vendor -->
    <script src="{{ Vite::asset('resources/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- for basic area chart -->

    <!-- App js-->
    <script src="{{ Vite::asset('resources/assets/js/app.js') }}"></script>
@endpush
