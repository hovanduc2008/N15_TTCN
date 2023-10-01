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
                                <th>ID</th>
                                <th>Người mượn</th>
                                <th>Sách</th>
                                <th>Ngày mượn</th>
                                <th>Ngày trả</th>
                                <th>Ngày trả thực tế</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrows as $borrow)
                                <tr>
                                    <td>#{{$borrow -> id}}</td>
                                    <td>
                                        <a href="{{route('admin.borrow.filterbyuser', ['user_id' => $borrow -> user_id, 'type' => 'all'])}}">
                                            {{$borrow -> customer -> name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.borrow.filterbyproduct', $borrow -> product_id)}}">
                                            {{$borrow -> product -> title}}
                                        </a>
                                    </td>
                                    <td>{{date_format(date_create($borrow -> borrow_date), 'H:m d/m/Y')}}</td>
                                    <td>
                                        {{ date_format(date_create($borrow->return_date), 'H:i d/m/Y') }}
                                    </td>
                                    <td>
                                        @if($borrow->actual_return_date)
                                            {{ date_format(date_create($borrow->actual_return_date), 'H:i d/m/Y') }}
                                        @else
                                            @if(time() > strtotime($borrow->return_date))
                                                <span class="badge badge-danger">Chưa trả</span>
                                            @else
                                                <span class="badge badge-warning">Chưa trả</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td></td>
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