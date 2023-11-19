@extends('layouts.user-onlyheader-layout')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/user-page/auth.css')}}">
@endsection

@section('main')
    <div class="auth-form">
        <div class="container">
            <div class="control">
                <p class = "active">Đăng Nhập</p>
                <p>Đăng Ký</p>
                <p>Quên mật khẩu</p>
            </div>
            <div class="form">
                <form action="" class="active-form login">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <div class="input">
                            <label for="">
                                Mật khẩu
                            </label>
                            <input type="text" placeholder = "Nhập mật khẩu...">
                        </div>
                        <button>Đăng nhập</button>
                    </div>
                </form>
                <form action="" class="register">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Họ, tên
                            </label>
                            <input type="text" placeholder = "Nhập họ, tên...">
                        </div>
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <div class="input">
                            <label for="">
                                Mật khẩu
                            </label>
                            <input type="text" placeholder = "Nhập mật khẩu...">
                        </div>
                        <div class="input">
                            <label for="">
                                Xác nhận mật khẩu
                            </label>
                            <input type="text" placeholder = "Nhập lại mật khẩu...">
                        </div>
                        <button>Đăng ký</button>
                    </div>
                </form>
                <form action="" class = "register">
                    <div class="contain">
                        <div class="input">
                            <label for="">
                                Email
                            </label>
                            <input type="text" placeholder = "Nhập địa chỉ email...">
                        </div>
                        <button>Lấy lại mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/user-auth.js')}}"></script>
@endsection