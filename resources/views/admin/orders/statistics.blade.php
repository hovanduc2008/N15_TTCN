@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";

    
@endphp

@section('main')
<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-primary"><i class="mdi mdi-cart-outline"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-primary">{{$countCustomer}}</span>
                Tổng số khách hàng
            </div>
            <div class="clearfix"></div>
            <p class=" mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-success"><i class="mdi mdi-currency-usd"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-success">{{$countBorrow}}</span>
                Số lượng đơn cho mượn
            </div>
            <div class="clearfix"></div>
            <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="mini-stat clearfix bg-white">
            <span class="mini-stat-icon bg-warning"><i class="mdi mdi-cube-outline"></i></span>
            <div class="mini-stat-info text-right">
                <span class="counter text-warning">{{$countOrder}}</span>
                Số lượng đơn bán
            </div>
            <div class="clearfix"></div>
            <p class="text-muted mb-0 m-t-20">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-12 col-xl-6">
        <div class="card m-b-20">
            <div class="card-body">
                <h4 class="mt-0 m-b-30 header-title">Top sách được mượn</h4>

                <div class="table-responsive">
                    <table class="table table-vertical mb-0">
                        <tbody>
                            @foreach($topProducts as $product)
                                <tr>
                                    <td>
                                        #{{$product -> id}}
                                    </td>
                                    <td>
                                        {{$product -> title}}
                                    </td>
                                    <td>
                                        {{$product -> borrow_count}}
                                        <p class="m-0 text-muted font-14">Lượt mượn</p>
                                    </td>
                                    
                                    <td>
                                        <a href = "#" class="btn btn-secondary btn-sm waves-effect">Detail</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-6">
        <div class="card m-b-20">
            <div class="card-body">
                <h4 class="mt-0 m-b-30 header-title">Top người mượn sách</h4>

                <div class="table-responsive">
                    <table class="table table-vertical mb-0">

                        <tbody>
                            @foreach($topCustomerBorrows as $customer)
                                <tr>
                                    <td>
                                        #{{$customer -> id}}
                                        
                                    </td>
                                    <td>
                                        {{$customer -> name}}
                                    </td>
                                    <td>
                                        {{$customer -> email}}
                                        <p class="m-0 text-muted font-14">Email</p>
                                    </td>
                                    <td>
                                        {{$customer -> borrow_count}}
                                        <p class="m-0 text-muted font-14">Lần mượn</p>
                                    </td>
                                    
                                    <td>
                                        <a href = "#" class="btn btn-secondary btn-sm waves-effect">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-6">
        <div class="card m-b-20">
            <div class="card-body">
                <h4 class="mt-0 m-b-30 header-title">Top người trả muộn</h4>

                <div class="table-responsive">
                    <table class="table table-vertical mb-0">

                        @foreach($topLateReturners as $customer)
                            <tr>
                                <td>
                                    #{{$customer -> id}}
                                    
                                </td>
                                <td>
                                    {{$customer -> name}}
                                </td>
                                <td>
                                    {{$customer -> email}}
                                    <p class="m-0 text-muted font-14">Email</p>
                                </td>
                                <td>
                                    {{$customer -> late_count}}
                                    <p class="m-0 text-muted font-14">Lần muộn</p>
                                </td>
                                
                                <td>
                                    <a href = "#" class="btn btn-secondary btn-sm waves-effect">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('scripts')
    
@endsection