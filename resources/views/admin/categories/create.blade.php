@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý danh mục";
    $sub_page_title = "Tạo mới danh mục";
@endphp

@section('main')

    <div class="p-3" >
        <form action="" method="post" enctype = "multipart/form-data">
            <div class="input-group input-group-outline mb-4">
                <label class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" name = "title">
            </div>
            <div class = "mt-4">
                <label for="">Hình ảnh</label>
                <input type="file" class="form-control" name="upload">
            </div>
            <div class = "d-flex justify-content-sm-end mt-3">
                <a href="{{route('admin.categories')}}" class = "btn btn-outline-secondary mx-sm-2">Quay lại</a>
                <button type = "submit" class = "btn btn-info">Create</button>
            </div>
            @csrf
        </form>
    </div>
@endsection






