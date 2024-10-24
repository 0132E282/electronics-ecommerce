@extends('layouts.admin')
@php
    $action = empty($brand->id) ? route('admin.brands.create') : route('admin.brands.edit', $brand);
    $method = empty($brand->id) ? 'POST' : 'PUT';
@endphp
@section('content')
    <div class="container-sm py-4">
        <div class="card p-4">
            <x-form :action="$action" :method="$method" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-2">
                        <div class="d-flex align-items-center justify-content-start me-2">
                            <x-form.field name="logo" label="Ảnh đại diện">
                                <x-form.images style="max-width: 220px;">
                                    <img class="img-fluid img-thumbnail" src="{{ Storage::url($brand->logo) }}" onerror="this.onerror=null; this.src='{{ Vite::asset('resources/assets/images/default/default-empty-file.png') }}';" alt="photo_url">
                                </x-form.images>
                            </x-form.field>
                        </div>
                    </div>
                    <div class="col ">
                        <x-form.field label="Tên danh mục" name="name">
                            <input type="text" class="form-control" value="{{ $brand->name ?? old('name') }}" placeholder="Nhập tên danh mục">
                        </x-form.field>
                        <x-form.field label="Mô tả" name="description" class="mt-3">
                            <textarea class="form-control" rows="6">{{ $brand->description ?? old('description') }}</textarea>
                        </x-form.field>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">{{ empty($brand->id) ? 'Thêm  mới' : 'Cập nhập' }} </button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-danger">Quay lại</a>
                </div>
            </x-form>
        </div>
    </div>
@endsection
