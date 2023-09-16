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
    <form action="" method="get">
        <div class="d-flex justify-content-bettwen">
            
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
    <a href="{{route('admin.category.create')}}" class = "btn btn-info">Thêm Danh Mục</a>
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
                        Category
                    </div>
                </td>
                <!-- <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Function</td> -->
                <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                    Trạng thái
                </td>
                <!-- <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employed</td> -->
                <td class="text-secondary opacity-7"></td>
                </tr>
            </thead>
            <tbody>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex px-3 py-1">
                                    <h6 class="text-uppercase text-secondary ">{{$category -> id}}</h6>
                                </div>
                            </td>
                            <td>
                                
                                <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{$category -> image}}" class="avatar avatar-md me-3 border-radius-sm">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xl">{{$category -> title}}</h6>
                                </div>
                                </div>
                            </td>
                            <!-- <td>
                                <p class="text-xs font-weight-bold mb-0">Manager</p>
                                <p class="text-xs text-secondary mb-0">Organization</p>
                            </td> -->
                            <td class="align-middle text-center text-sm">
                                    @if($category -> status == 1)
                                        <span class="badge bg-gradient-success">Enable</span>
                                    @else
                                        <span class="badge bg-gradient-danger">Disable</span>
                                    @endif
                            </td>
                            <!-- <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-normal">23/04/18</span>
                            </td> -->
                            <td class="align-middle">
                                <a href="{{route('admin.category.edit', $category -> id)}}" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan = "4">
                            <span class="badge bg-gradient-danger">Không tìm thấy danh mục</span>
                        </td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>
    </div>
@endsection