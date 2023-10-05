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

    $pagination = $products;
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
                                <select name="" id="limit" class = "form-control">
                                    <option value="5">Hiển thị 5</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name = "id" class="form-control" placeholder = "Tìm theo mã">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="text" name = "name" class = "form-control" placeholder = "Tìm theo tên">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <select name="sort" id="" class = "form-control">
                                <option value="">Sắp sếp theo tên</option>
                            </select>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <select name="author" class = "form-control" id="">
                                    <option value="">
                                        Tác giả
                                    </option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="" class = "form-control" id="">
                                    <option value="">Danh mục</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-2 ml-2">
                        <div class="row">
                            <button class="btn btn-info" type="submit">Lọc</button>
                        </div>
                        <br>
                        <div class="row">
                            <a class="btn btn-secondary" href="{{route('admin.customers')}}">Hủy lọc</a>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="row">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sách</th>
                                <th>Ngày xuất bản</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="product-list-img">
                                        <img src="{{$product -> thumbnail}}" class="img-fluid" alt="tbl">
                                    </td>
                                    <td>
                                        <h6 class="mt-0 m-b-5">{{$product -> title}}</h6>
                                        <p class="m-0 font-14">{{$product -> description}}</p>
                                    </td>
                                    
                                    <td>{{date_format(date_create($product -> publication_date), 'd/m/Y')}}</td>
                                    <td>{{number_format($product -> quantity)}}</td>
                                    <td>{{number_format($product -> price)}}đ</td>
                                
                                    <td>
                                        <a href="{{route('admin.product.edit', $product -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                        <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa sản phẩm', 'Sản phẩm này sẽ bị xóa và không thể khôi phục', '{{route('admin.product.delete', $product -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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
