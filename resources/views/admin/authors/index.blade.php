@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý tác giả";

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
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày sinh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author -> name }}</td>
                                <td>{{ $author -> gender }}</td>
                                <td>{{ $author -> email }}</td>
                                <td>{{ $author -> phone_number }}</td>
                                <td>{{ $author -> address }}</td>
                                
                                <td>{{ $author -> date_of_birth ? date_format(date_create($author -> date_of_birth), 'd/m/Y') : '' }}</td>
                                <td>
                                    <a href="{{route('admin.author.edit', $author -> id)}}" class="m-r-15 text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-pencil font-18"></i></a>
                                    <button class = "btn-danger" data-toggle="modal" data-target=".bs-delete-modal-sm" onclick = "modalConfirmDelete('Xác nhận xóa tác giả', 'Tác giả này sẽ bị xóa và không thể khôi phục', '{{route('admin.author.delete', $author -> id)}})')" class="text-muted" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="mdi mdi-close font-18"></i></button>
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