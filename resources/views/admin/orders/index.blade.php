@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";

    $status_option = [
        [
            "title" => "Đang xử lý",
            "color" => "bg-gradient-warning"
        ],
        [
            "title" => "Đã giao hàng",
            "color" => "bg-gradient-success"
        ],
        [
            "title" => "Hủy đơn",
            "color" => "bg-gradient-danger"
        ],
    ];

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
    ];
@endphp

@section('main')
<form action="" method="get">
        <div class="d-flex justify-content-between">
        
            <div class="input-group input-group-static mb-4">
                <label for="sort_filter">Sắp xếp theo</label>
                <select class = "form-control" name="sort_filter" id = "sort_filter">
                    @foreach($sort_option as $key => $value)
                        @if(isset($old_filters['sort_filter']))
                            @if($key == $old_filters['sort_filter'])
                                <option selected value="{{$key}}">{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                        @else
                            <option value="{{$key}}">{{$value}}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="status_filter">Trạng Thái </label>
                <select class = "form-control" name="status_filter" id = "status_filter">
                    @foreach($status_option as $key => $value)
                        @if(isset($old_filters['status_filter']))
                            @if($key == $old_filters['status_filter'])
                                <option selected value="{{$key}}">{{$value['title']}}</option>
                            @else
                                <option value="{{$key}}">{{$value['title']}}</option>
                            @endif
                        @else
                            <option value="{{$key}}">{{$value['title']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class = "input-group input-group-static mb-4">
                <label for="id">Mã đơn hàng</label>
                <input class = "form-control" type="text" value = "{{$old_filters['id'] ?? ''}}" placeholder = "Mã đơn hàng..." name = "id" id = "id">
            </div>
            <div class="">
                <button class = "btn btn-sm btn-success mx-2">
                    <span class="material-icons opacity-10">
                        filter_alt
                    </span>
                </button>
                <a href="{{route('admin.orders')}}" class = "btn btn-sm btn-outline-secondary mx-2">
                    <span class="material-icons opacity-10">
                        clear_all
                    </span>
                </a>
            </div>
        
        </div>
    </form>
<div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
            <thead>
                <tr>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-3 py-1">
                        ID
                    </div>
                </td>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-3 py-1">
                        Người nhận
                    </div>
                </td>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-3 py-1">
                        Địa chỉ
                    </div>
                </td>
                <!-- <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Function</td> -->
                <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    Trạng thái
                </td>
                <td class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    Thành tiền
                </td>
                <!-- <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employed</td> -->
                <td class="text-secondary opacity-7"></td>
                </tr>
            </thead>
            <tbody>
                @if(count($orders) > 0)
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="text-xl font-weight-normal mb-0">{{$order -> id}}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="text-xl font-weight-normal mb-0 ">{{$order -> full_name}}</h6>
                                </div>
                            </td>
                            
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="text-xl font-weight-normal mb-0 ">{{$order -> shipping_address}}</h6>
                                </div>
                            </td>

                            <td class="align-middle text-center text-sm">
                                    @foreach($status_option as $key => $status)
                                        @if($key == $order -> status)
                                            <span class="badge {{$status['color']}}">{{$status['title']}}</span>
                                        @endif
                                    @endforeach
                            </td>
                            <td>
                                <div class="d-flex px-1 py-1">
                                <p class="text-xl font-weight-normal mb-0">{{number_format($order -> total_order_value)}}đ</p>
                                </div>
                            </td>
                            
                            <td class="align-middle">
                                <a href="{{route('admin.orders.detail', $order -> id)}}" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" >
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan = "4">
                            <span class="badge bg-gradient-danger">Không tìm thấy đơn hàng</span>
                        </td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>
    </div>
@endsection