
@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đầu sách";
    $sub_page_title = "Tạo mới Sách";
    
@endphp

@section('main')
    @if(count($authors) > 0 && count($categories) > 0)
    <div class="p-3" >
            <form action="" method="post" enctype = "multipart/form-data">
                <div class="input-group input-group-outline mb-4">
                    <label class="form-label">ISBN</label>
                    <input type="text" class="form-control" name = "ISBN">
                </div>
                <div class="input-group input-group-outline mb-4">
                    <label class="form-label">Tên sách</label>
                    <input type="text" class="form-control" name = "title">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="exampleFormControlSelect1" class="ms-0">Tác giả</label>
                    <select class="form-control" id="exampleFormControlSelect1" name = "author">
                        @foreach ($authors as $author)
                            <option value = "{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="exampleFormControlSelect1" class="ms-0">Danh mục</label>
                    <select class="form-control" id="exampleFormControlSelect1" name = "category">
                        @foreach ($categories as $category)
                            <option value = "{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-outline mb-4">
                    <label class="form-label">Giá</label>
                    <input type="number" class="form-control" name = "price">
                </div>
                <div class="input-group input-group-outline mb-4">
                    <label class="form-label">Số lượng có</label>
                    <input type="number" class="form-control" name = "quantity">
                </div>
                <div>
                    <label for="">Mô tả</label>
                    <textarea name="" id="" class = "form-control" cols = "100" name="description"></textarea>
                </div>
                <div class = "mt-4">
                    <label for="">Hình ảnh</label>
                    <input type="file" class="form-control" name="upload">
                </div>
                <div class = "d-flex justify-content-sm-end mt-3">
                    <a href="{{route('admin.products')}}" class = "btn btn-outline-secondary mx-sm-2">Quay lại</a>
                    <button type = "submit" class = "btn btn-info">Create</button>
                </div>
                @csrf
            </form>
        </div>
    @endif
    @if(!count($authors))
        <h3>Vui lòng <a href="{{route('admin.author.create')}}">thêm Tác giả</a> trước khi tạo Sách</h3>
    @endif
    @if(!count($categories))
        <h3>Vui lòng <a href="{{route('admin.category.create')}}">thêm Danh mục</a> trước khi tạo Sách</h3>
    @endif
</div>
@endsection