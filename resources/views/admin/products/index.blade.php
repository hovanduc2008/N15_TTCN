@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đầu sách";
    $hasFilter = true;

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
        "price_asc" => "Giá tăng dần",
        "price_desc" => "Giá giảm dần",
        "a_z" => "Từ A-Z",
        "z_a" => "Từ Z-A",
    ];


    $status_option = [
        "2" => "Tất cả",
        "1" => "Enabled",
        "0" => "Disabled"
    ];
@endphp

@section('main')
    <form action="" method = "GET">
        <div class="d-flex justify-content-bettwen align-items-sm-center">
            <div style = "min-width: 205px" class = "me-2">
                <div class="input-group input-group-static mb-4">
                    <label>Giá từ:</label>
                    <input class = "form-control" type="number" value = "{{$old_filters['price_start'] ?? ''}}" name = "price_start" placeholder = "Start...">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Đến:</label>
                    <input class = "form-control" type="number" value = "{{$old_filters['price_end'] ?? ''}}" name = "price_end" placeholder = "End...">
                </div>
            </div>
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
            <div class = "input-group input-group-static mb-4">
                <label for="keyword">Từ khóa</label>
                <input class = "form-control" type="text" value = "{{$old_filters['keyword'] ?? ''}}" placeholder = "Từ khóa..." name = "keyword" id = "keyword">
            </div>
            <div class="">
                <button class = "btn btn-sm btn-success mx-2">
                    <span class="material-icons opacity-10">
                        filter_alt
                    </span>
                </button>
                <a href="{{route('admin.authors')}}" class = "btn btn-sm btn-outline-secondary mx-2">
                    <span class="material-icons opacity-10">
                        clear_all
                    </span>
                </a>
            </div>
        
        </div>
    </form>
    <a href="{{route('admin.product.create')}}" class = "btn btn-info">Thêm Sản Phẩm</a>
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
                        Sách
                    </div>
                </td>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-1 py-1">
                        Ngày xuất bản
                    </div>
                </td>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-2 py-1">
                        Giá
                    </div>
                </td>
                <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    <div class="d-flex px-1 py-1">
                        Số lượng
                    </div>
                </td>
                <!-- <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Function</td> -->
                <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Trạng thái</td>
                <!-- <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employed</td> -->
                <td class="text-secondary opacity-7"></td>
                </tr>
            </thead>
            <tbody>
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="text-uppercase text-secondary ">{{$product -> id}}</h6>
                                </div>
                            </td>
                            <td>
                                
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{$product -> image}}" class="avatar avatar-md me-3 border-radius-sm">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-xl">{{$product -> title}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xl font-weight-normal mb-0">{{date_format(date_create($product->publication_date), 'd-m-Y')}}</p>
                            </td>
                            <td>
                                <div class="d-flex px-1 py-1">
                                <p class="text-xl font-weight-normal mb-0">{{number_format($product -> price)}}đ</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-1 py-1">
                                <p class="text-xl font-weight-normal mb-0">{{number_format($product -> quantity)}}</p>
                                </div>
                            </td>
                            

                            <!-- <td>
                                <p class="text-xs font-weight-bold mb-0">Manager</p>
                                <p class="text-xs text-secondary mb-0">Organization</p>
                            </td> -->
                            <td class="align-middle text-center text-sm">
                                    @if($product -> status == 1)
                                        <span class="badge bg-gradient-success">Enable</span>
                                    @else
                                        <span class="badge bg-gradient-danger">Disable</span>
                                    @endif
                            </td>
                            
                            <td class="align-middle">
                                <a href="{{route('admin.product.edit', $product -> id)}}" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan = "4">
                            <span class="badge bg-gradient-danger">Không tìm thấy sản phẩm</span>
                        </td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>
    </div>
@endsection
