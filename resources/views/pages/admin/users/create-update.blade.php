@extends('layouts.admin')

@section('content')
    <div class="container-sm py-3">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 fs-5">Thêm người dùng</h1>
            </div>
            <div class="card-body">
                <x-Form action="{{ empty($user->id) ? route('admin.users.create') : route('admin.users.edit', $user) }}" method="{{ empty($user->id) ? 'post' : 'put' }}" id="form-user" enctype="multipart/form-data">
                    <div class="d-flex w-100 gap-4">
                        <div class="w-100" style="max-width: 200px;">
                            <x-form.field name="photo_url" label="Ảnh đại diện">
                                <x-form.images>
                                    <div style="max-width: 200px;">
                                        <img class="img-fluid img-thumbnail" src="{{ Storage::url($user->photo_url) ?? '' }}" onerror="this.onerror=null; this.src='{{ Vite::asset('resources/assets/images/default/avatar.jpg') }}';" alt="photo_url">
                                    </div>
                                </x-form.images>
                            </x-form.field>
                        </div>
                        <div class="w-100">
                            <x-form.field name="name" label="Tên hiển thị">
                                <input type="text" class="form-control" value="{{ $user->name ?? old('name') }}" required>
                            </x-form.field>
                            <x-form.field name="email" label="Email {{ $user->id ? '( là duy nhất không thể cập nhâp )' : '' }}" class="mt-3">
                                <input type="email" class="form-control" {{ !empty($user->id) ? 'disabled' : '' }} value="{{ $user->email ?? old('email') }}" required>
                            </x-form.field>
                            <x-form.field name="password" label="Mật khẩu" class="mt-3">
                                <div class="row create-password">
                                    <x-form.input-password name="password" class="col" />
                                    <span class="btn btn-primary col-1 btn-create-password">Tự động</span>
                                </div>
                            </x-form.field>
                            <x-form.field name="rolues" label="Quyền quản lý" class="mt-3">
                                <select class="form-control">
                                    <option value="">Chọn quyền Tài khoản</option>
                                </select>
                            </x-form.field>
                        </div>
                    </div>
                </x-Form>
            </div>
            <div class="card-footer">
                <button type="submit" form="form-user" class="btn btn-primary">{{ empty($user->id) ? 'Thêm Mới' : 'Cập nhập' }} </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ml-2">Quay Lại</a>
            </div>
        </div>
    </div>
@endsection
