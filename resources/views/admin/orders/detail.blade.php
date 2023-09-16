@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đơn hàng";
    $sub_page_title = "Chi tiết đơn hàng";

    $order_status = [
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
@endphp

@section('main')
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group input-group-static my-3">
                    <label>Mã đơn hàng: </label>
                    <input type="email" class="form-control" disabled  value = "#{{$foundOrder -> id}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-static my-3">
                    <label>Người nhận: </label>
                    <input type="email" class="form-control" disabled  value = "{{$foundOrder -> full_name}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-static my-3">
                    <label>Địa chỉ: </label>
                    <input type="email" class="form-control" disabled value = "{{$foundOrder -> shipping_address}}">
                </div>
            </div>
            <div class = "col-md-6">
                <div class="input-group input-group-static my-3">
                    <label>Trạng thái:  </label>
                    <form action="{{route('admin.orders.change_status', $foundOrder -> id)}}" method = "POST">
                            @foreach($order_status as $key => $status)
                                @if($key == $foundOrder -> order_status)
                                <div class="form-check is-filled">
                                    <input checked value = "{{$key}}" class="form-check-input" type="radio" name="status" id="customRadio1">
                                    <label class="custom-control-label" for="customRadio1">
                                        <span class="badge {{$status['color']}}">{{$status['title']}}</span>
                                    </label>
                                </div>
                                @else
                                <div class="form-check">
                                    <input value = "{{$key}}" class="form-check-input" type="radio" name="status" id="customRadio1">
                                    <label class="custom-control-label" for="customRadio1">
                                        <span class="badge {{$status['color']}}">{{$status['title']}}</span>
                                    </label>
                                </div>
                                @endif
                            @endforeach
                            <button class = "btn btn-info btn-sm mt-2">Update Status</button>
                            @csrf
                            @method('PUT')
                            
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Danh sách sản phẩm</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Sách</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Giá</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Số lượng</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product) 
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{$product -> IMAGE}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$product -> TITLE}}</h6>
                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{$product -> order_item_price}}đ</p>
                            
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-success">{{$product -> quantity}}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{$product -> quantity * $product -> order_item_price}}</span>
                        </td>

                        </tr>
                    @endforeach
                  </tbody> 
                  <tfoot>
                        <tr>
                            <td class=" text-center" colspan = "3">
                                <span class="text-secondary text-xs font-weight-bold">Tổng Cộng</span>
                            </td>
                            <td class=" text-center">
                                <span class="text-secondary text-xss">{{$foundOrder -> total_order_value}}</span>
                            </td>
                        </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection