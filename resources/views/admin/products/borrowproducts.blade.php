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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sách</th>
                            <th>Tác giả</th>
                            <th>Ngày xuất bản</th>
                            <th>Giá/ngày</th>
                            <th>Đang cho mượn</th>
                            <th>Sẵn có</th>
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
                            <td>Nguyen Nhat Anh</td>
                            <td>{{date_format(date_create($product -> publication_date), 'd/m/Y')}}</td>
                            <td>{{number_format($product -> price)}}đ</td>
                            <td>
                                <a href="{{route('admin.borrow.filterbyproduct', $product -> id)}}">{{$product -> borrowing -> count()}}</a>
                                
                            </td>
                            <td>
                                @if($product -> quantity > 0)
                                    {{$product -> quantity}}
                                @else
                                    <span class = "">Hết sách</span>
                                @endif
                            </td>
                            
                        
                            <td>
                                <a href="{{route('admin.product.edit', $product -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                {!$product -> quantity > 0 ? <a href="{{ route('admin.borrow.create').'?product_id='.$product -> id }}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="Tạo đơn cho sản phẩm này" data-original-title="Create-Borrow"><i class="mdi mdi mdi-account-plus font-18"></i></a> : '' !}
                                
                                <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa sản phẩm', 'Sản phẩm này sẽ bị xóa và không thể khôi phục', '{{route('admin.product.delete', $product -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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
