@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý tác giả";
    $sub_page_title = "Sửa thông tin tác giả";
@endphp

@section('main')

    <div class="p-3" >
        <form action="" method="post" enctype = "multipart/form-data">
            <div class="input-group input-group-static mb-4">
                <label>Mã tác giả</label>
                <input type="text" disabled  class="form-control" value = "{{$foundAuthor -> id}}">
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Tên tác giả</label>
                <input type="text" class="form-control" name = "name" value = "{{$foundAuthor -> name}}">
            </div>
            <div>
                <label for="">Tiểu sử</label>
                <textarea name="" id="" class = "form-control" cols = "100" name="biography">
                    {{$foundAuthor -> biography}}
                </textarea>
            </div>
            <div>
                <label for="">Trạng thái</label>
                @if($foundAuthor -> status == 1) 
                    <input checked type="checkbox" name = "is_active"> 
                @else
                    <input type="checkbox" name = "is_active">
                @endif
            </div>
            <div class = "mt-4">
                <label for="">Hình ảnh: </label>
                <img src="{{$foundAuthor -> image}}" alt="">
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
                <a href="{{route('admin.authors')}}" class = "btn btn-outline-secondary mx-sm-2">Quay lại</a>
                <button type="button" 
                onclick = "renderModal('{{route('admin.author.delete', $foundAuthor -> id)}}')" 
                class="btn me-2 bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Xóa Tác Giả
                </button>
                <button type = "submit" class = "btn btn-info">Update</button>
            </div>
            @csrf
            @method('PUT')
        </form>
    </div>
@endsection
    <script>
        var $ = document.querySelector.bind(document);
        function renderModal (route) {
            
            $('.modal-title').innerHTML = 'Xác nhận xóa tác giả';
            $('.modal-body').innerHTML = 'Các sách thuộc tác giả này sẽ bị xóa';
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
@section('scripts')
@endsection





