@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý danh mục";

    $status_option = [
        "2" => "Tất cả",
        "1" => "Enabled",
        "0" => "Disabled"
    ];

    $sort_option = [
        "latest" => "Mới nhất",
        "oldest" => "Cũ nhất",
        "a_z" => "Từ A-Z",
        "z_a" => "Từ Z-A",
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
                                <th>Image</th>
                                <th>Category Name</th>
                                <th>Added Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="product-list-img">
                                        <img src="{{$category -> thumbnail}}" class="img-fluid" alt="tbl">
                                    </td>
                                    <td>
                                        <h6 class="mt-0 m-b-5">{{$category -> title}}</h6>
                                        <p class="m-0 font-14">{{$category -> description}}</p>
                                    </td>
                                    <td>{{date_format(date_create($category -> created_at), 'd/m/Y H:m:s')}}</td>
                                    
                                
                                    <td>
                                        <a href="{{route('admin.category.edit', $category -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                        <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa danh mục', 'Danh mục này sẽ bị xóa và không thể khôi phục', '{{route('admin.category.delete', $category -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></>
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