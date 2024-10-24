@extends('layouts.admin')

@php
    $rowHade = [
        [
            'name' => 'Tên danh mục',
            'sort' => 'name',
        ],
        [
            'name' => 'Người tạo',
            'sort' => 'user_id',
        ],
        [
            'name' => 'Trạng thái',
            'sort' => 'display',
        ],

        [
            'name' => 'Ngày tạo',
            'sort' => 'created_at',
        ],
        [
            'name' => 'nôi bật',
        ],
    ];
    $menus = [
        [
            'title' => 'Tất cả',
            'url' => route('admin.users.index'),
        ],
        [
            'title' => 'Người dùng',
            'url' => route('admin.users.index'),
        ],
        [
            'title' => 'Admin',
            'url' => route('admin.users.index'),
        ],
        [
            'title' => 'Đã khóa',
            'url' => route('admin.users.index'),
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
                    {{-- filter theo tên --}}
                    <div class=" col-6">
                        <label for="search-input" class="form-label">Tìm kiếm</label>
                        <x-form.field class="input-group" name="search">
                            <input type="text" class="form-control" placeholder="Tìm kiếm theo tên hoạt email" value="{{ request()->input('search') ?? '' }}">
                            <span class="input-group-text" id="basic-addon1">
                                <i data-feather="search" class="noti-icon"></i>
                            </span>
                        </x-form.field>
                    </div>
                    {{-- filter theo ngày  --}}
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
                    <a href="{{ route(Route::currentRouteName(), ['type' => request()->route('type')]) }}" class="btn btn-danger">Xóa </a>
                </div>
            </x-form>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                {{-- hiển thị menu --}}
                <ul class="nav ">
                    @foreach ($menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ $menu['url'] }}">{{ $menu['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div style="margin-left: auto;">
                    <a href="{{ route('admin.categories.create', ['type' => request()->route('type'), 'parent' => request()->route('categories')?->id]) }}" class="btn btn-primary">Tạo Mới</a>
                    <button class="btn btn-danger action-delete-multiple" data-action="{{ route('admin.categories.delete-multiple', ['type' => request()->route('type')]) }}" data-method="delete">Xóa nhiều</button>
                </div>
            </div>
            <div class="card-body">
                <x-form id="form-aciton">
                    <input type="hidden" name="_method">
                    <x-table.data :rowHead="$rowHade">
                        @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input checkbox-table-body">
                                    </th>
                                    <td>
                                        <img class="rounded img-fluid float-start me-2" src="{{ Storage::url($category->thumbnail) }}" alt="{{ $category->name }}"
                                            onerror="this.onerror=null; this.src='{{ Vite::asset('resources/assets/images/default/default-empty-file.png') }}';" style="max-width: 50px; max-height: 50px;">
                                        <p class="mt-0 mb-0">{{ $category->name }}</p>
                                    </td>
                                    <td>
                                        {{ $category->user->name }}
                                    </td>
                                    <td>
                                        <span class="badge px-4 py-2  w-100 text-bg-{{ $category->display === 1 ? 'success' : 'danger' }}" style="max-width: 100px;">{{ $category->display === 1 ? 'Hiển thị' : 'Ẩn đi' }}</span>
                                    </td>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge text-bg-primary">
                                            <i data-feather="star" class="noti-icon"></i>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <!-- hành động -->
                                        <div class="btn-group aciton-data-table">
                                            <button type="button" class="btn  hidden-icon-dropdown dropdown-toggle" style="margin-left: auto;" id="table-actions" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="table-actions">
                                                {{-- hiển thị danh mục con --}}
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.categories.index', ['categories' => $category, ...request()->route()->originalParameters()]) }}">
                                                        <i data-feather="bookmark" class=" me-1 " style="width: 20px; height: 20px;"></i>
                                                        danh mục con
                                                    </a>
                                                </li>
                                                {{-- sữ lý ẩn hiện --}}
                                                <li>
                                                    <button type="button" class="dropdown-item action-block"
                                                        data-action="{{ route('admin.categories.status', [$category, 'type' => $category->type, 'status' => $category->display == 1 ? 'hide' : 'display']) }}" data-method="patch"
                                                        type="{{ $category->display == 1 ? 'hide' : 'display' }}">
                                                        @if ($category->display == 1)
                                                            <i data-feather="eye-off" class="me-1" style="width: 20px; height: 20px;"></i>
                                                            Ẩn đi
                                                        @else
                                                            <i data-feather="eye" class="me-1" style="width: 20px; height: 20px;"></i>
                                                            Hiển thị
                                                        @endif
                                                    </button>
                                                </li>
                                                {{-- sữ lý cập nhập --}}
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.categories.edit', [$category, 'type' => request()->route('type')]) }}">
                                                        <i data-feather="edit" class="me-1 " style="width: 20px; height: 20px;"></i>
                                                        cập nhập
                                                    </a>
                                                </li>
                                                {{-- sữ lý xóa --}}
                                                <li>
                                                    <button type="button" class="dropdown-item action-delete" data-action="{{ route('admin.categories.destroy', ['type' => $category->type, $category]) }}" data-method="delete">
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
                            {{-- hiển thị khi không có danh mục --}}
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
                {{ !empty($categories) ? $categories->links() : '' }}
            </div>
        </div>
    </div>
@endsection
@push('body-js')
    <script type="module">
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
