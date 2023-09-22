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
            "title" => "Đã hủy",
            "color" => "bg-gradient-danger"
        ],
    ];

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
    ];
@endphp

@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Order Date</th>
                        <th>Payment</th>
                        <th>Billing Name</th>
                        <th>Status</th>
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
                                <td>{{$order -> payment_method}} </td>
                                <td>{{$order -> order_title}}</td>
                                <td><span class="badge badge-success">{{$order -> status}}</span></td>
                                <td>
                                    <a href="{{route('admin.orders.detail', $order -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                    <a href="javascript:void(0);" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Datatable js -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection