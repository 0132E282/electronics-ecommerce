@extends('layouts.empty')

@push('head')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ Vite::asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ Vite::asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-7 mx-auto">
                            <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                <div class="mb-4 p-0">
                                    <a class='auth-logo' href='index.html'>
                                        <img src=" {{ Vite::asset('resources/assets/images/logo-dark.png') }}" alt="logo-dark" class="mx-auto" height="28" />
                                    </a>
                                </div>

                                <div class="pt-0">
                                    <x-form action="{{ route('login', ['type' => 'admin']) }}" class="my-4">
                                        <x-form.field class="mb-3" name="email" label="Email đăng nhập">
                                            <input class="form-control" type="email" placeholder="Nhập email đăng nhập của bạn">
                                        </x-form.field>

                                        <x-form.field class="mb-3" name="password" label="Nhập mật khẩu đăng nhập">
                                            <x-form.input-password placeholder="Nhập mật khẩu của bạn" />
                                        </x-form.field>
                                        <div class="form-group d-flex mb-3">
                                            <div class="col-sm-6">
                                                <x-form.field class="form-check" name="remember-password" label="Nhớ mật khẩu">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                                </x-form.field>
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a class='text-muted fs-14' href='auth-recoverpw.html'>Quên mật khẩu</a>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit"> Đăng nhập </button>
                                                </div>
                                            </div>
                                        </div>
                                    </x-form>

                                    <div class="saprator my-4"><span>Đăng nhập khác</span></div>

                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn text-dark border fw-normal bg-white d-flex align-items-center justify-content-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48" class="me-2">
                                                    <path fill="#ffc107"
                                                        d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917" />
                                                    <path fill="#ff3d00" d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691" />
                                                    <path fill="#4caf50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44" />
                                                    <path fill="#1976d2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917" />
                                                </svg>
                                                <span>Đăng nhập với Google</span>
                                            </a>
                                        </div>

                                        <div class="col-12">
                                            <a class="btn btn-primary fw-normal d-flex align-items-center justify-content-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="me-2">
                                                    <path fill="#ffffff" d="M9.198 21.5h4v-8.01h3.604l.396-3.98h-4V7.5a1 1 0 0 1 1-1h3v-4h-3a5 5 0 0 0-5 5v2.01h-2l-.396 3.98h2.396z" />
                                                </svg>
                                                <span>Đăng nhập với Facebook</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="account-page-bg p-md-5 p-4">
                        <div class="text-center">
                            <h3 class="text-dark mb-3 pera-title">Chào mừng bạn đến với Tapeli Admin</h3>
                            <div class="auth-image">
                                <img src="{{ Vite::asset('resources/assets/images/authentication.svg') }}" class="mx-auto img-fluid" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('body-js')
    <!-- Vendor -->
    <script src="{{ Vite::asset('resources/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- for basic area chart -->
    {{-- <script src="../../../apexcharts.com/samples/assets/stock-prices.js"></script> --}}

    <!-- App js-->
    <script src="{{ Vite::asset('resources/assets/js/app.js') }}"></script>
@endpush
