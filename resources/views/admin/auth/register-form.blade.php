@extends('layouts.auth-layout')

@php
    $page_title = "Đăng Ký";
@endphp

@section('main')
    <form action="" method="post">
        @if($errors -> any())
            <ul>
                @foreach ($errors -> all() as $error)
                    <li>{{$error}}</li>;
                @endforeach
            </ul>
        @endif
        <div class = "input_label">
            <label for="">Name</label>
            <input type="text" name = "name">
        </div>
        <div class = "input_label">
            <label for="">Email</label>
            <input type="text" name = "email">
        </div>
        <div class = "input_label">
            <label for="">Password</label>
            <input type="password" name = "password">
        </div>
        <div class = "input_label">
            <label for="">Password Confirm</label>
            <input type="password" name = "password-confirmation">
        </div>
        @csrf
        <button type = "submit" class = "submit">Đăng Ký</button>
        <p>Bạn đã có tài khoản? <a href="{{route('admin.login')}}">Đăng nhập</a></p>
    </form>
@endsection