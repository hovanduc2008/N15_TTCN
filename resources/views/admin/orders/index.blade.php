@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";

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

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất"
    ];

    $limit_option = [
        5, 10, 20, 30, 50    
    ];

    $pagination = $orders;
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <form class="row" method = "GET">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                
                                <select name="limit" id="limit" class = "form-control">
                                    @foreach($limit_option as $value)
                                        @if(isset($current_filters['limit']) && $value == $current_filters['limit'])
                                            <option selected value="{{$value}}">Hiển thị {{$value}}</option>
                                        @else
                                            <option value="{{$value}}">Hiển thị {{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="sort_filter" id="" class = "form-control">
                                    @foreach($sort_option as $key => $option)
                                        @if(isset($current_filters['sort_filter']) && $key == $current_filters['sort_filter'])
                                            <option selected value="{{$key}}">{{$option}}</option>
                                        @else
                                            <option  value="{{$key}}">{{$option}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col">
                        <div class="row">
                            <input type="text" class = "form-control" placeholder = "Tìm kiếm..." value = "{{$current_filters['search'] ?? ''}}" name = "search">
                        </div>
                    </div>
                    <div class="col-2 ml-3">
                        <div class="row">
                            <button class="btn btn-info" type="submit">Lọc</button>
                            <a class="btn btn-secondary ml-2" href="{{route('admin.orders')}}">Hủy lọc</a>    
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Giá trị</th>
                            <th>Ngày đặt</th>
                            <th>PTTT</th>
                            <th>Nội dung</th>

                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="#" class="font-600 text-muted">#{{$order -> id}}</a>
                                    </td>
                                    <td>{{number_format($order -> total_amount)}}đ</td>
                                    <td>{{date_format(date_create($order -> created_at), 'd/m/Y H:m')}}</td>
                                    <td>{{$order -> payment_method == 1 ? 'Nhận hàng' : 'Online'}} </td>
                                    <td style = "max-width: 180px; padding: 0 10px; overflow: hidden">{{$order -> order_title}}</td>
                                    <td><span class="{{$status_option[(int)$order -> order_status]['color']}}"> {{$status_option[(int)($order -> order_status)]['title']}}</span></td>
                                    <td class = "text-center">
                                        <a title = "Chi tiết" href="{{route('admin.orders.detail', $order -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-information font-18"></i></a>
                                        <!-- <a href="javascript:void(0);" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('partials.admin.pagination')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
@endsection