@extends('layouts.auth-layout')

@php
    $page_title = "Đăng Nhập";
@endphp

@section('main')
    <form action="" method="post">
        @if($errors -> any())
            <div class = "alert alert-danger">
                @foreach ($errors -> all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            
            </div>
        @endif
        <div class = "input_label">
            <label for="">Email</label>
            <input type="text" name = "email">
        </div>
        <div class = "input_label">
            <label for="">Password</label>
            <input type="text" name = "password">
        </div>
        @csrf
        <button type = "submit" class = "submit">Đăng Nhập</button>
        <p>Bạn chưa có tài khoản? <a href="{{route('admin.register')}}">Đăng ký</a></p>
    </form>
@endsection



