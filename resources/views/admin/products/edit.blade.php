
@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đầu sách";
    $sub_page_title = "Sửa thông tin Sách";
@endphp

@section('main')
    <div class="p-3" >
        <form action="" method="post" enctype = "multipart/form-data">
            <div class="input-group input-group-static mb-4">
                <label>Mã sách</label>
                <input type="text" disabled  class="form-control" value = "{{$foundProduct -> id}}">
            </div>
            <div class="input-group input-group-static mb-4">
                    <label>ISBN</label>
                    <input type="text" class="form-control" name = "ISBN" value = "{{$foundProduct -> ISBN}}">
                </div>
            <div class="input-group input-group-static mb-4">
                <label>Tên sách</label>
                <input type="text" class="form-control" name = "title" value = "{{$foundProduct -> title}}">
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="exampleFormControlSelect1" class="ms-0">Tác giả</label>
                <select class="form-control" id="exampleFormControlSelect1" name = "author">
                    @foreach ($authors as $author)
                        @if($foundProduct -> author_id == $author->id)
                            <option selected value = "{{ $author->id }}">{{ $author->name }}</option>
                        @else
                            <option value = "{{ $author->id }}">{{ $author->name }}</option>
                        @endif                                                
                    @endforeach            
                </select>
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="exampleFormControlSelect1" class="ms-0">Danh mục</label>
                <select class="form-control" id="exampleFormControlSelect1" name = "category">
                    @foreach ($categories as $category)
                        @if($foundProduct -> category_id == $category->id)
                            <option selected value = "{{ $category->id }}">{{ $category->title }}</option>
                        @else
                            <option value = "{{ $category->id }}">{{ $category->title }}</option>
                        @endif                                                
                    @endforeach            
                </select>
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Giá</label>
                <input type="number" class="form-control" value = "{{$foundProduct -> price}}" name = "price">
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Số lượng</label>
                <input type="number" class="form-control" value = "{{$foundProduct -> quantity}}" name = "quantity">
            </div>
            <div >
                <label for="">Mô tả</label>
                <textarea name="" id="" class = "form-control" cols = "100" name="description">
                    {{$foundProduct -> description}}
                </textarea>
            </div>
            <div class="input-group input-group-static mb-4 mt-4">
                <label>Ngày xuất bản</label>
                <input type="date" class="form-control" value = "{{ $foundProduct->publication_date }}" name = "publication_date">
            </div>
            <div>
                <label for="">Trạng thái</label>
                @if($foundProduct -> status == 1) 
                    <input checked type="checkbox" name = "is_active"> 
                @else
                    <input type="checkbox" name = "is_active">
                @endif
            </div>
            <div class = "mt-4">
                <label for="">Hình ảnh: </label>
                <img src="{{$foundProduct -> image}}" alt="">
            </div>
            <div class = "mt-4">
                <label for="">Xóa Hình ảnh: </label>
                <input type="checkbox" name="is_delete">
            </div>
            <div class = "mt-4">
                <label for="">Thay đổi Hình ảnh</label>
                <input type="file" class="form-control" name="upload">
            </div>
            <div class = "d-flex justify-content-sm-end mt-3">
                <a href="{{route('admin.categories')}}" class = "btn btn-outline-secondary mx-sm-2">Quay lại</a>
                <button type = "submit" class = "btn btn-info">Update</button>
            </div>
            @csrf
            @method('PUT')
        </form>
    </div>
@endsection