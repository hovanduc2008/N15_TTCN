@extends('layouts.user-onlyheader-layout')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/user-page/search.css')}}">
@endsection

@section('main')
    <div class="main-content search-content">
        <div class="container">
            <div class="left">
                @include('partials.user.sidebar-filter')
            </div>
            <div class="right">
                <div class="search-rs">
                    <h2>Kết tìm kiếm cho từ khóa "sách hay"</h2>
                    <div class="type-flag">
                        <a href="#all" class = "item active">Tất cả(126)</a>
                        <a href="#sachban" class = "item">Sách bán(103)</a>
                        <a href="#sachchomuon" class = "item">Sách cho mượn(13)</a>
                    </div>  
                    <div class="product-list">
                        <a class="product-item" href = "#">
                            @if(true)
                                <div class="typebusiness">Cho mượn</div>
                            @endif
                            <img src="https://cdn0.fahasa.com/media/catalog/product/c/o/combo-072020-8.jpg" alt="">
                            <p class="title">Combo 30 Chủ Đề Từ Vựng Tiếng Anh - Tập 1 + 2 (Bộ 2)</p>
                            <div class="real-price">249.508 ₫</div>
                            <div class="old-price">380.000 ₫</div>
                        </a>
                        <a class="product-item">
                            <img src="https://cdn0.fahasa.com/media/catalog/product/i/m/image_195509_1_20301.jpg" alt="">
                            <p class="title">Combo 30 Chủ Đề Từ Vựng Tiếng Anh - Tập 1 + 2 (Bộ 2)</p>
                            <div class="real-price">249.508 ₫</div>
                            <div class="old-price">380.000 ₫</div>
                        </a>
                        <a class="product-item">
                            <img src="https://cdn0.fahasa.com/media/catalog/product/9/7/9786043605310.jpg" alt="">
                            <p class="title">Combo 30 Chủ Đề Từ Vựng Tiếng Anh - Tập 1 + 2 (Bộ 2)</p>
                            <div class="real-price">249.508 ₫</div>
                            <div class="old-price">380.000 ₫</div>
                        </a>
                        <a class="product-item">
                            <img src="https://cdn0.fahasa.com/media/catalog/product/c/o/combo-072020-8.jpg" alt="">
                            <p class="title">Combo 30 Chủ Đề Từ Vựng Tiếng Anh - Tập 1 + 2 (Bộ 2)</p>
                            <div class="real-price">249.508 ₫</div>
                            <div class="old-price">380.000 ₫</div>
                        </a>
                        <a class="product-item">
                            <img src="https://cdn0.fahasa.com/media/catalog/product/c/o/combo-072020-8.jpg" alt="">
                            <p class="title">Combo 30 Chủ Đề Từ Vựng Tiếng Anh - Tập 1 + 2 (Bộ 2)</p>
                            <div class="real-price">249.508 ₫</div>
                            <div class="old-price">380.000 ₫</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection