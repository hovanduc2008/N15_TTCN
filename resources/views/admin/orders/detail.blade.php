@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";
    $sub_page_title = "Chi tiết đơn hàng";

    $status_option = [
        [
            "title" => "Đang xử lý",
            "color" => "badge badge-warning"
        ],
        [
            "title" => "Đã duyệt",
            "color" => "badge badge-info"
        ],
        [
            "title" => "Đang chuẩn bị",
            "color" => "badge badge-warning"
        ],
        [
            "title" => "Đang giao hàng",
            "color" => "badge badge-warning"
        ],
        [
            "title" => "Đã giao hàng",
            "color" => "badge badge-success"
        ],
        [
            "title" => "Đã hủy",
            "color" => "badge badge-danger"
        ],
    ];
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="pull-right font-16"><strong>Order # {{$foundOrder -> id}}</strong></h4>
                            <h3 class="m-t-0">
                                BooksStore
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <address>
                                    <strong>Thông tin người nhận:</strong><br>
                                    {{$foundOrder -> user -> name}},<br>
                                    {{$foundOrder -> user -> phone_number}},<br>
                                    {{$foundOrder -> user -> email}},<br>
                                </address>
                            </div>
                            <div class="col-6 text-right">
                                <address>
                                    <strong>Địa điểm giao hàng:</strong><br>
                                    {{$foundOrder -> shipping_address}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 m-t-30">
                                <address>
                                    <strong>Phương thức thanh toán:</strong><br>
                                    {{$foundOrder -> payment_method == 1 ? 'Thanh toán khi nhận hàng' : 'Online'}}
                                </address>
                            </div>
                            <div class="col-6 m-t-30 text-right">
                                <address>
                                    <strong>Ngày đặt:</strong><br>
                                    {{date_format(date_create($foundOrder -> created_at), 'd/m/Y')}}<br><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 m-t-30">
                                <strong>Trạng thái đơn hàng</strong><br>
                                <form action = "{{route('admin.orders.change_status', $foundOrder -> id)}}" method = "POST" class="row">
                                    <div class="col-6">
                                        <div clas`s="form-group">
                                            
                                            <select class="form-control" name = "status">
                                                @foreach ($status_option as $index => $value)
                                                    @if($index == $foundOrder -> order_status)
                                                        <option selected value="{{$index}}">{{$value['title']}}</option>
                                                    @else
                                                        <option value="{{$index}}">{{$value['title']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>`
                                    </div>
                                    @method('PUT')
                                    @csrf
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </form>
                                
                        
                            </div>
                            <div class="col-6 m-t-30 text-right">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="panel panel-default">
                            <div class="p-2">
                                <h3 class="panel-title font-20"><strong>Danh sách sản phẩm</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Tên sản phẩm</strong></td>
                                            <td class="text-center"><strong>Giá</strong></td>
                                            <td class="text-center"><strong>Số lượng</strong>
                                            </td>
                                            <td class="text-right"><strong>Thành tiền</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{$product -> id}}</td>
                                                <td>{{$product -> TITLE}}</td>
                                                <td class="text-center">{{number_format($product -> item_price)}}</td>
                                                <td class="text-center">{{$product -> quantity}}</td>
                                                <td class="text-right">{{number_format(($product -> item_price) * ($product -> quantity))}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-print-none">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection