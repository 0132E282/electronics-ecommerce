@extends('layouts.admin')
@php
    $rowHade = [
        [
            'name' => 'Tên người dùng',
            'sort' => 'name',
        ],
        [
            'name' => 'Email',
            'sort' => 'Email',
        ],
        [
            'name' => 'Vai trò',
        ],
        [
            'name' => 'Khóa Tài khoản',
            'sort' => 'locked_at',
        ],

        [
            'name' => 'Ngày tạo',
            'sort' => 'created_at',
        ],
    ];
    $menus = [
        [
            'title' => 'Tất cả',
            'url' => route('admin.users.index'),
        ],
        [
            'title' => 'Người dùng',
            'url' => route('admin.users.index', ['type' => 'locked']),
        ],
        [
            'title' => 'Admin',
            'url' => route('admin.users.index', ['type' => '']),
        ],
        [
            'title' => 'Đã khóa',
            'url' => route('admin.users.index', ['type' => 'locked']),
        ],
    ];
@endphp
@section('content')
    <div class="container-fluid py-3">
        @if (session('message'))
            <div class="alert alert-{{ session('message.type') }}" role="alert">
                {{ session('message.content') }}
            </div>
        @endif
        <div class="card p-4">
            <x-form method="get">
                <div class="row">
                    <div class=" col-6">
                        <label for="search-input" class="form-label">Tìm kiếm</label>
                        <x-form.field class="input-group" name="search">
                            <input type="text" class="form-control" placeholder="Tìm kiếm theo tên thương hiệu" value="{{ request()->input('search') ?? '' }}">
                            <span class="input-group-text" id="basic-addon1">
                                <i data-feather="search" class="noti-icon"></i>
                            </span>
                        </x-form.field>
                    </div>
                    <div class="row col-6">
                        <label for="search-input" class="form-label">Tìm kiếm theo ngày</label>
                        <x-form.field class="col" name="created[]" value="{{ request()->created[0] ?? '' }}">
                            <input type="date" class="form-control">
                        </x-form.field>
                        <x-form.field class="col" name="created[]" value="{{ request()->created[1] ?? '' }}">
                            <input type="date" class="form-control">
                        </x-form.field>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a href="{{ route(Route::currentRouteName()) }}" class="btn btn-danger">Xóa </a>
                </div>
            </x-form>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <ul class="nav ">
                    @foreach ($menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ $menu['url'] }}">{{ $menu['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div style="margin-left: auto;">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tạo Mới</a>
                    <button class="btn btn-danger action-delete-multiple" data-action="{{ route('admin.users.delete-multiple') }}" data-method="delete">Xóa nhiều</button>
                </div>
            </div>
            <div class="card-body">
                <x-form id="form-aciton">
                    <input type="hidden" name="_method">
                    <x-table.data :rowHead="$rowHade">
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="user[]" value="{{ $user->id }}" class="form-check-input checkbox-table-body">
                                    </th>
                                    <td>
                                        <img class="rounded img-fluid float-start me-2" src="{{ Storage::url($user->photo_url) }}" alt="{{ $user->name }}"
                                            onerror="this.onerror=null; this.src='{{ Vite::asset('resources/assets/images/default/avatar.jpg') }}';" style="max-width: 50px; max-height: 50px;">
                                        <p class="mt-0 mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td></td>
                                    <td>{{ $user->locked_at ? $user->created_at->format('d/m/Y H:i') : ' ' }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <!-- Example single danger button -->
                                        <div class="btn-group aciton-data-table">
                                            <button type="button" class="btn  hidden-icon-dropdown dropdown-toggle" style="margin-left: auto;" id="table-actions" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="table-actions">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i data-feather="eye" class=" me-1 " style="width: 20px; height: 20px;"></i>
                                                        Xem
                                                    </a>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item action-block" data-action="{{ route('admin.users.locked', [$user, 'type' => $user->locked_at ? 'unblock' : 'locked']) }}" data-method="patch"
                                                        type="{{ $user->locked_at ? 'unblock' : 'block' }}">
                                                        @if ($user->locked_at)
                                                            <i data-feather="unlock" class="me-1" style="width: 20px; height: 20px;"></i>
                                                            Mỡ khóa
                                                        @else
                                                            <i data-feather="lock" class="me-1" style="width: 20px; height: 20px;"></i>
                                                            khóa tài khoản
                                                        @endif
                                                    </button>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                                        <i data-feather="edit" class="me-1 " style="width: 20px; height: 20px;"></i>
                                                        cập nhập
                                                    </a>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item action-delete" data-action="{{ route('admin.users.destroy', $user) }}" data-method="delete">
                                                        <i data-feather="trash" class=" me-1" style="width: 20px; height: 20px;"></i>
                                                        xóa tài khoản
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($rowHade) + 2 }}">
                                    <div class="d-flex py-5">
                                        <div class="py-5 m-auto">
                                            <img style="max-width: 120px;" class="img-fluid mx-auto d-block" src="{{ Vite::asset('resources/assets/images/default/default-empty-file.png') }}" alt="">
                                            <p class="fs-5 mt-0">Không có dữ liệu</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </x-table.data>
                </x-form>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
@push('body-js')
    <script>
        $('.action-delete').on('click', function() {
            const formAction = $("#form-aciton");
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa tài khoản này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    formAction.attr('action', $(this).attr('data-action'));
                    formAction.find("input[name='_method']").val($(this).attr('data-method'));
                    formAction.submit()
                }
            });
        })
        $('.action-delete-multiple').on('click', function() {
            const formAction = $("#form-aciton");
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa tài khoản này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    formAction.attr('action', $(this).attr('data-action'));
                    formAction.find("input[name='_method']").val($(this).attr('data-method'));
                    formAction.submit()
                }
            });
        })
        $('.action-block').on('click', function() {
            const formAction = $("#form-aciton");
            Swal.fire({
                title: $(this).attr('type') === 'block' ? "Bạn có chắc chắn muốn khóa tài khoản này?" : "Bạn có chắc chắn muốn mỡ khóa tài khoản này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    formAction.attr('action', $(this).attr('data-action'));
                    formAction.find("input[name='_method']").val($(this).attr('data-method'));
                    formAction.submit()
                }
            });
        })
    </script>
@endpush
