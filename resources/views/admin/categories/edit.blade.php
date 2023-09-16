@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý danh mục";
    $sub_page_title = "Sửa thông tin danh mục";
@endphp

@section('main')

    <div class="p-3" >
        <form action="" method="post" enctype = "multipart/form-data">
            <div class="input-group input-group-static mb-4">
                <label>Mã danh mục</label>
                <input type="text" disabled  class="form-control" value = "{{$foundCategory -> id}}">
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Tên danh mục</label>
                <input type="text" class="form-control" name = "title" value = "{{$foundCategory -> title}}">
            </div>
            <div>
                <label for="">Trạng thái</label>
                @if($foundCategory -> status == 1) 
                    <input checked type="checkbox" name = "is_active"> 
                @else
                    <input type="checkbox" name = "is_active">
                @endif
            </div>
            <div class = "mt-4">
                <label for="">Hình ảnh: </label>
                <img src="{{$foundCategory -> image}}" alt="">
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
                <button type="button" 
                onclick = "renderModal('{{route('admin.category.delete', $foundCategory -> id)}}')" 
                class="btn me-2 bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Xóa Danh Mục
                </button>
                <button type = "submit" class = "btn btn-info">Update</button>
            </div>
            @csrf
            @method('PUT')
        </form>
    </div>
@endsection


@section('scripts')
    <script>
        var $ = document.querySelector.bind(document);
        function renderModal (route) {
            
            $('.modal-title').innerHTML = 'Xác nhận xóa danh mục';
            $('.modal-body').innerHTML = 'Các sách thuộc danh mục này sẽ bị xóa và không thể khôi phục!';
            var btnSubmit = `
                <form action = "${route}" method='post'>
                    @csrf
                    @method('DELETE')
                    <button type='submit' class = "btn btn-danger" name=''>Xác nhận xóa</button>
                </form>
            `
            $('.modal-footer').innerHTML = btnSubmit;
        }
    </script>

@endsection





