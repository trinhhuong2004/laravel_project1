@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <link href="{{ asset('backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thêm mới sản phẩm</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Sản phẩm</a>
                </li>
                <li class="active">
                    <strong>Thêm mới sản phẩm</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('admins.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Thông tin sản phẩm</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a></li>
                                    <li><a href="#">Config option 2</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12 b-r">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" name="name" placeholder="Nhập tên" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')
                                        <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price" placeholder="Nhập giá sản phẩm" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                                        @error('price')
                                        <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giá khuyến mại</label>
                                        <input type="text" name="price_sale" placeholder="Nhập giá khuyến mại" class="form-control @error('price_sale') is-invalid @enderror" value="{{ old('price_sale') }}">
                                        @error('price_sale')
                                        <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title m-t-md">
                            <p><a href="#">Hình ảnh sản phẩm:</a></p>
                            <div class="input-container">
                                <i class="fa fa-image"></i>
                                <input type="file" name="img_thumb" class="form-control @error('img_thumb') is-invalid @enderror" value="{{ old('img_thumb') }}" onchange="showImagePro(event)">
                                @error('img_thumb')
                                <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                @enderror
                                <img id="img_hinh_anh" src="" alt="" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        <div class="ibox-title m-t-md">
                            <p><a href="#">Album hình ảnh sản phẩm:</a></p>
                            <input type="file" name="product_galleries[]" multiple class="form-control @error('product_galleries') is-invalid @enderror" onchange="showImageAlbum(event)">
                            @error('product_galleries.*')
                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                            @enderror
                            <div id="image-gallery" class="image-gallery">
                                <!-- Các ảnh sẽ được hiển thị ở đây -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Đăng</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-title" style="height: 270px">
                            <p><i class="fa fa-pinterest-p"></i> Loại sản phẩm:</p>
                            @php
                                $types = [
                                    'is_best_sale' => 'Bán chạy',
                                   'is_40_sale' => 'Giảm 40%',
                                   'is_hot_online' => 'Hot online',
                               ]
                            @endphp
                            <div class="button-container">
                                @foreach($types as $key => $value)
                                    <div class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" value="{{ $key }}" name="{{$key}}" id="customCheck-{{$key}}">
                                        <label for="customCheck-{{$key}}"> {{$value}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="m-t-sm"><i class="fa fa-pinterest-p"></i> Trạng thái:</p>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="1" name="is_active" checked="">
                                <label for="inlineRadio1"> Hiển thị </label>
                            </div>
                            <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio2" value="0" name="is_active">
                                <label for="inlineRadio2"> Ẩn </label>
                            </div>
                            <div class="form-group">
                                <label class="m-t-sm"> Mã sản phẩm </label>
                                <input type="text" name="sku" value="{{ strtoupper(\Str::random(8)) }}" placeholder="Mã sản phẩm" class="form-control @error('sku') is-invalid @enderror">
                                @error('sku')
                                <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs m-b" type="submit"><strong>Đăng</strong></button>
                            </div>
                        </div>
                        <div class="ibox-title m-t-md">
                            <h5>Danh mục sản phẩm</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a></li>
                                    <li><a href="#">Config option 2</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-title">
                            <p><i class="fa fa-pinterest-p"></i> <a href=""> Tất cả danh mục:</a></p>
                            @foreach($categories as $id => $name)
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox{{ $id }}" type="radio" name="category_id" value="{{ $id }}">
                                    <label for="checkbox{{ $id }}">{{ $name }}</label>
                                </div>
                            @endforeach
                            <a href="#" id="toggleForm"><i class="fa fa-plus"></i> Thêm mới danh mục</a>
                            <div id="categoryFormContainer" style="display: none;">
                                <form id="categoryForm" action="{{ route('admins.categories.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="m-l m-t-sm">Tên danh mục:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Tên danh mục">
                                            @error('name')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="m-l">Hình ảnh:</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" value="{{ old('cover') }}" onchange="showImage(event)">
                                            @error('cover')
                                            <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                                            @enderror
                                            <img id="img_danh_muc" src="" alt="Hình ảnh sản phẩm" style="width: 100px; display: none;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="m-l">Trạng Thái:</label>
                                        <div class="col-sm-12">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="is_active" checked="">
                                                <label for="inlineRadio1">Hiển thị</label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="inlineRadio2" value="0" name="is_active">
                                                <label for="inlineRadio2">Ẩn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Thêm danh mục mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
@section('js')
    <script>
        document.getElementById('toggleForm').addEventListener('click', function(e) {
            e.preventDefault();
            var formContainer = document.getElementById('categoryFormContainer');
            if (formContainer.style.display === 'none' || formContainer.style.display === '') {
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        });

        document.getElementById("categoryForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Ngăn hành vi mặc định của form

            var formData = new FormData(this);

            fetch("{{ route('admins.categories.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Danh mục đã được thêm thành công!");
                        document.getElementById("categoryForm").reset();
                        document.getElementById("categoryForm").style.display = "none";
                    } else {
                        document.getElementById("nameError").innerText = data.errors.name;
                        document.getElementById("nameError").style.display = "block";
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    </script>

    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('backend/js/inspinia.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script>

    <!-- SUMMERNOTE -->
    <script src="{{ asset('backend/js/plugins/summernote/summernote.min.js') }}"></script>

    <!-- Data picker -->
    <script src="{{ asset('backend/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script>
        function showImageAlbum(event) {
            const files = event.target.files;
            const gallery = document.getElementById('image-gallery');
            gallery.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = () => {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    gallery.appendChild(img);
                };
                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }

        function showImagePro(event) {
            const img_hinh_anh = document.getElementById('img_hinh_anh');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = () => {
                img_hinh_anh.src = reader.result;
                img_hinh_anh.style.display = 'block';
            };
            if (file) {
                reader.readAsDataURL(file);
            } else {
                img_hinh_anh.style.display = 'none';
            }
        }
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc'); // Đảm bảo rằng ID của phần tử ảnh là 'img_danh_muc'
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
    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });
    </script>
@endsection
