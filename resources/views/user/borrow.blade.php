@extends('layouts.user-onlyheader-layout')

@section('style')
    <style>
        .borrow {
            display: flex;
            justify-content: center;
            font-size: 1.6rem;
        }

        .borrow .container {
            margin: 7px 0
        }

        .borrow form {
            display: grid;
            grid-template-columns: 3fr 1fr;
            grid-gap: 7px;
        }

        .borrow .title {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 500;
        }

        .borrow .left {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 7px;
        }
        
        .borrow .left .product-info,
        .borrow .left .order-info,
        .borrow .right .total-price {
            background: #fff;
            border-radius: 5px;
            padding: 20px 13px;
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

        .borrow .product-info {
            display: flex;

        }

        .borrow .product-info img {
            max-height: 200px;
        }

        .borrow .product-info .content {
            display: flex;
            flex-direction: column;
            padding-bottom: 20px;
        }

        .borrow .product-info .content h3{
            font-weight: 500;
            margin-bottom: 13px;
        }

        .borrow .product-info .content p {
            padding: 5px 0;
        }

        .borrow .product-info .content .price {
            font-weight: 500;
            margin-top: 13px;
            font-size: 1.8rem;
            color: #146EBE;
        }

        .product-info .img {
            height: 250px;
            display: flex;
            justify-content: center;
            width: 250px;
        }

        .right .info-pay div{
            display: flex;
            justify-content: space-between;
        }
        .right .info-pay div p {
            padding: 2px 0;
        }

        .right .info-pay {
            border-bottom: 1px solid #ccc;
            margin-bottom: 7px;
            padding-bottom: 7px;
        }

        .order-info input,
        .order-info select {
            height: 35px;
            width: 100%;
            margin-top: 5px;
            padding: 0 7px;
        }

        .order-info textarea {
            width: 100%;
            padding: 0 7px;
        }

        .order-info label {
            display: block;
            font-size: 1.7rem;
            margin-top: 20px;
        }


        .order-info .time {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 13px; 
        }
        
    </style>
@endsection

@section('main')
    <div class="borrow">
        <div class="container">
            @if(true)
                <h2 class="title">
                    MƯỢN SÁCH
                </h2>
                <form action="{{route('handle_borrow', ['id' => 'id'])}}" method="post">
                    <div class="left">
                        <div class="product-info">
                            <div class="img">
                                <img src="{{$foundProduct -> image}}" alt="">
                            </div>
                            <div class="content">
                                <h3>{{$foundProduct -> title}}</h3>
                                <p>ISBN: {{$foundProduct -> ISBN}}</p>
                                <p>Tác giả: {{$foundProduct -> author -> name}}</p>
                                @if($foundProduct -> pdf_link)
                                    <a target = "_blank" href="{{$foundProduct -> pdf_link ?? ''}}">Đọc thử</a>
                                @endif
                                <p class="price">{{$foundProduct -> price}} đ / ngày</p>
                                
                            </div>
                        </div>
                        <div class="order-info">
                            <h3 class="order-title">
                                Thông tin đơn hàng
                            </h3>
                            <div class="time">
                                <div class="time1">
                                    <label for="">Ngày mượn</label>
                                    <input type="datetime-local" name="" id="">
                                </div>
                                <div class="time1">
                                    <label for="">Ngày trả dự kiến</label>
                                    <input type="datetime-local" name="" id="">
                                </div>
                            </div>
                            <div class="branch">
                                <label for="">Nhận sách tại</label>
                                <select name="" id="">
                                    <option value="">123 ABC, Từ Liêm, Hà Nội</option>
                                </select>
                            </div>
                            <div class="note">
                                <label for="">Ghi chú</label>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="total-price">
                            <h3>Thành tiền</h3>
                            <div class = "info-pay">
                                <div>
                                    <p>Giá</p>
                                    <p>1000 đ</p>
                                </div>
                                <div>
                                    <p>Số ngày mượn</p>
                                    <p>0 ngày</p>
                                </div>
                            </div>
                            <div class="pay-price">
                                <p>Tổng Số Tiền</p>
                                <p>0 đ</p>
                            </div>
                            <button class = "btn-pay">
                                THANH TOÁN
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <h1>404</h1>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
