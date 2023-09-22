
@extends('layouts.admin-layout')

@php
    $page_title = "Quản lý đầu sách";
    $sub_page_title = "Tạo mới Sách";

@endphp

@section('main')
    @if(count($authors) > 0 && count($categories) > 0)
        <form action="{{route('admin.product.handleCreate')}}" method="post" enctype = "multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Basic Information</h4>
                            <p class="text-muted m-b-30 font-14">Fill all information below</p>

                            <div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ISBN">ISBN</label>
                                            <input id="ISBN" name="ISBN" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Book Name</label>
                                            <input id="title" name="title" type="text" class="form-control">
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name = "description" id="description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="publication_date">Publication date</label>
                                            <input id="publication_date" name="publication_date" type="date" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input id="quantity" name="quantity" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input id="price" name="price" type="text" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Author</label>
                                            <select class="form-control select2" name = "author" required>
                                                @foreach($authors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control select2" name = "category" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Product Image</label> <br/>
                                            <img src="assets/images/products/1.jpg" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                            <br/>
                                            <input type="file" name="upload_image" class="btn btn-purple m-t-10 waves-effect waves-light">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" name = "content" id="content" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success waves-effect waves-light">Create</button>
                                <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Meta Data</h4>
                            <p class="text-muted m-b-30 font-14">Fill all information below</p>

                            <div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <input id="meta_title" name="meta_title" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input id="meta_keywords" name="meta_keywords" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" name = "meta_description" id="meta_description" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    @endif
    @if(!count($authors))
        <h3>Vui lòng <a href="{{route('admin.author.create')}}">thêm Tác giả</a> trước khi tạo Sách</h3>
    @endif
    @if(!count($categories))
        <h3>Vui lòng <a href="{{route('admin.category.create')}}">thêm Danh mục</a> trước khi tạo Sách</h3>
    @endif
</div>
@endsection