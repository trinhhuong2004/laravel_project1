@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Danh sách danh mục</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Danh mục</a>
                </li>
                <li class="active">
                    <strong>Thêm mới danh mục</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Thông tin danh mục</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> Dữ liệu</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <form action="{{ route('admins.categories.update', $category->id) }} " class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group"><label class="col-sm-2 control-label">Tên danh mục:</label>
                                        <div class="col-sm-10"><input
                                                type="text" name="name"
                                                class="form-control @error('name') is_valid @enderror" value="{{ $category->name }}" placeholder="Tên danh mục">
                                            @error('name')
                                            <p class="text-danger" style="margin-top: 5px"> {{ $message }} </p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh:</label>
                                        <div class="col-sm-10"><input
                                                type="file" name="cover"
                                                class="form-control" onchange="showImage(event)">
                                            <img src="{{ Storage::url($category->cover) }}" id="img_danh_muc" width="70px" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Trạng Thái:</label>
                                        <div class="col-sm-4">
                                            <fieldset>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="1" {{ $category->is_active == true ? 'checked' : '' }} name="is_active">
                                                    <span class="label label-primary">Hiển thị</span>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="0" {{ $category->is_active == false ? 'checked' : '' }} name="is_active">
                                                    <span class="label label-danger">Ẩn</span>
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>

                                    <div class="btn-create">
                                        <button type="submit" class="btn-primary">Cập nhật</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
