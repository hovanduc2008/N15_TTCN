@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .cart {
            display: flex;
            justify-content: center;
            font-size: 1.6rem;
        }

        .cart .title {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 500;
        }

        .cart .container {
            margin: 7px 0;
        }

        .cart .container .cart-content {
           display: grid;
           grid-template-columns: 3fr 1fr;
           grid-gap: 10px;
        }

        .cart-content .right .total-price,
        .cart-content .left .cart-header,
        .cart-content .left .cart-body {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px 13px;
        }

        .cart-content .left .cart-header {
            margin-bottom: 10px;
            padding: 13px;
            display: flex;
            justify-content: space-between;
        }

        .cart-body .product-item {
            display: flex;
        }

        .cart .info {
            flex:1;
            display: flex;
        }
        .cart .info img {
            height: 100px;
        }

        .cart .info .img {
            width: 180px;
        }

        .cart .item-action {
            width: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart .item-action button {
            border: none;
            background-color: transparent;
            font-size: 2rem;
            color: red;
            cursor: pointer;
        }

        .cart .item-action button:hover {
            opacity: 0.8;
        }

        .cart .item-total {
            width: 180px;
            padding-left: 7px;
        }

        .cart-body .item-total {
            color: #146EBE;
            font-size: 1.7rem;
            font-weight: 500;
        }

        .cart .item-total,
        .cart .item-quantity {
            display: flex;
            align-items: center;
        }

        .cart .item-action button:focus,
        .cart-content .select input[type="checkbox"]:focus {
            outline: none;
        }


        .cart-content .select {
            width: 20px;
            
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-content .select input[type="checkbox"] {
            height: 1.6rem;
            width: 1.6rem;
        }

        .cart-content .select input[type="checkbox"]:checked {
            background: red;
        }

        .cart .item-quantity {
            width: 140px;
            padding-left: 7px;
        }

        .detail-info .price {
            display: flex;
            align-items: flex-end;
            margin-top: 20px;
        }

        .detail-info .price .real-price {
            color: #000;
            font-size: 1.7rem;
            font-weight: 500;
            padding-right: 7px;
        }

        .detail-info .price .old-price {
            color: #8491A3;
            font-weight: 300;
            font-size: 1.5rem;
            text-decoration: line-through;
        }

        .product-item {
            padding: 13px 0;
            border-bottom: 1px solid #ccc;
        }

        .product-item:nth-last-child(1) {
            border: none;
            padding-bottom: 0;
        }

        .right .total-price {
            display: flex;
            flex-direction: column;
            
        }

        .right .total-price h3 {
            font-size: 1.8rem;
            padding-bottom: 5px;
            font-weight: 400;
            border-bottom: 1px solid #ccc;
            margin-bottom: 13px;
        }

        .right .total-price .pay-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .btn-pay {
            height: 40px;
            border: none;
            border-radius: 5px;
            background: #ddd;
            font-size: 1.6rem;
            color: #fff;
            cursor: pointer;
        }

        .btn-pay:focus {
            outline: none;
        }

        .right .total-price .pay-price .btn-active {
            background-color: var(--primary-color-1);
        }

        .pay-price p:nth-child(1) {
            font-weight: bold;
        }

        .pay-price p:nth-child(2) {
            color: #146EBE;
            font-size: 1.7rem;
            font-weight: 500;
        }
        
    </style>
@endsection

@section('main')
    <div class="cart">
        <div class="container">
            <h2 class="title">
                GIỎ HÀNG (2 sản phẩm)
            </h2>
            <div class="cart-content">
                <div class="left">
                    <div class="cart-header">
                        <div class="select">
                            <input type="checkbox">
                        </div>
                        <div class = "info" style = "margin-left: 7px">
                            <span>Chọn tất cả (2 sản phẩm)</span>
                        </div>
                        <div class = "item-quantity">
                            <span>Số lượng</span>
                        </div>
                        <div class = "item-total">
                            <span>Thành tiền</span>
                        </div>
                        <div class = "item-action">
                            
                        </div>
                    </div>
                    <div class="cart-body">
                        <div class="product-item">
                            <div class="select">
                                <input type="checkbox" name="" id="">
                            </div>
                            <div class="info">
                                <div class="img"><img src="https://cdn0.fahasa.com/media/catalog/product//9/7/9786043603590.jpg" alt=""></div>
                                <div class="detail-info">
                                    <div class="name">Chiến Tranh Tiền Tệ Phần IV: Siêu Cường Về Tài Chính - Tham Vọng Về Đồng Tiền Chung Châu Á</div>
                                    <div class="price">
                                        <p class="real-price">114.700 đ</p>
                                        <p class="old-price">185.000 đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class = "item-quantity">
                                <input type="text" style = "width: 50px">
                            </div>
                            <div class = "item-total">
                                114.700đ
                            </div>
                            <div class = "item-action">
                                <button><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="product-item">
                            <div class="select">
                                <input type="checkbox" name="" id="">
                            </div>
                            <div class="info">
                                <div class="img"><img src="https://cdn0.fahasa.com/media/catalog/product//9/7/9786043603590.jpg" alt=""></div>
                                <div class="detail-info">
                                    <div class="name">Chiến Tranh Tiền Tệ Phần IV: Siêu Cường Về Tài Chính - Tham Vọng Về Đồng Tiền Chung Châu Á</div>
                                    <div class="price">
                                        <p class="real-price">114.700 đ</p>
                                        <p class="old-price">185.000 đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class = "item-quantity">
                                <input type="text" style = "width: 50px">
                            </div>
                            <div class = "item-total">
                                114.700đ
                            </div>
                            <div class = "item-action">
                                <button><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="product-item">
                            <div class="select">
                                <input type="checkbox" name="" id="">
                            </div>
                            <div class="info">
                                <div class="img"><img src="https://cdn0.fahasa.com/media/catalog/product//9/7/9786043603590.jpg" alt=""></div>
                                <div class="detail-info">
                                    <div class="name">Chiến Tranh Tiền Tệ Phần IV: Siêu Cường Về Tài Chính - Tham Vọng Về Đồng Tiền Chung Châu Á</div>
                                    <div class="price">
                                        <p class="real-price">114.700 đ</p>
                                        <p class="old-price">185.000 đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class = "item-quantity">
                                <input type="text" style = "width: 50px">
                            </div>
                            <div class = "item-total">
                                114.700đ
                            </div>
                            <div class = "item-action">
                                <button><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="total-price">
                        <h3>Thành tiền</h3>
                        <div class="pay-price">
                            <p>Tổng Số Tiền</p>
                            <p>0 đ</p>
                        </div>
                        <button class = "btn-pay">
                            THANH TOÁN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
