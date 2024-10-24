@extends('layouts.admin')

@section('content')
    <div class="container-sm py-4">
        <div class="card p-4">
            <x-form :action="empty($category->id) ? route('admin.categories.create', ['parent' => request()->parent, 'type' => $type]) : route('admin.categories.edit', ['categories' => request()->parent, 'categories' => $category, 'type' => $category->type])" method="{{ empty($category->id) ? 'post' : 'put' }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-2">
                        <div class="d-flex align-items-center justify-content-start me-2">
                            <x-form.field name="thumbnail" label="Ảnh đại diện">
                                <x-form.images style="max-width: 220px;">
                                    <img class="img-fluid img-thumbnail" src="{{ Storage::url($category->thumbnail) }}" onerror="this.onerror=null; this.src='{{ Vite::asset('resources/assets/images/default/default-empty-file.png') }}';" alt="photo_url">
                                </x-form.images>
                            </x-form.field>
                        </div>
                    </div>
                    <div class="col ">
                        <x-form.field label="Tên danh mục" name="name">
                            <input type="text" class="form-control" value="{{ $category->name ?? old('name') }}" placeholder="Nhập tên danh mục">
                        </x-form.field>
                        <x-form.field label="Danh mục cha" class="mt-3" name="parent_id">
                            <x-category.select :categories="$categories" :value="$category->id ?? (request()->input('parent') ?? old('parent_id'))" />
                        </x-form.field>
                        <x-form.field label="Mô tảc" name="description" class="mt-3">
                            <textarea class="form-control" rows="3">{{ $category->description ?? old('description') }}</textarea>
                        </x-form.field>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">{{ $category->id ? 'Cập nhập' : 'Thêm mới' }}</button>
                    <a href="{{ route('admin.categories.index', ['type' => request()->route('type')]) }}" class="btn btn-danger">Quay lại</a>
                </div>
            </x-form>
        </div>
    </div>
@endsection
