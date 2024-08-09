@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link href="{{ asset('backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Danh sách slide</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Slide</a>
                </li>
                <li class="active">
                    <strong>{{ $title }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
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
                                <form id="categoryForm" action="{{ route('admins.sliders.update', $slide->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tiêu đề:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $slide->name }}" placeholder="Tên danh mục">
                                            @error('name')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Đường dẫn:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ $slide->url }}" placeholder="Đường dẫn">
                                            @error('url')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Hình ảnh:</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="thumb" class="form-control @error('thumb') is-invalid @enderror" value="{{ $slide->thumb }}" onchange="showImage(event)">
                                            @error('thumb')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                            <img src="{{ Storage::url($slide->thumb) }}" id="img_danh_muc" width="70px" alt="">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sắp xếp:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="sort_by" class="form-control @error('sort_by') is-invalid @enderror" value="{{ $slide->sort_by }}" placeholder="Sắp xếp">
                                            @error('sort_by')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Trạng Thái:</label>
                                        <div class="col-sm-4">
                                            <fieldset>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="{{ $slide->is_active }}" name="is_active" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                                    <label for="inlineRadio1">Hiển thị</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="{{ $slide->is_active }}" name="is_active" {{ old('is_active') == '0' ? 'checked' : '' }}>
                                                    <label for="inlineRadio2">Ẩn</label>
                                                </div>
                                            </fieldset>
                                            @error('is_active')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-10 col-sm-offset-2 ">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <!-- Nội dung tab 2 -->
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
