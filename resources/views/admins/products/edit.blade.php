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
            <h2>{{ $title }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Sản phẩm</a>
                </li>
                <li class="active">
                    <strong>{{$title}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
{{--        @dd($product->all())--}}
        <form action="{{ route('admins.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-9">
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
                                        <input type="text" name="name" placeholder="Nhập tên " value="{{ old('name', $product->name) }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" name="price" placeholder="Nhập giá sale" value="{{  $product->price }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá khuyến mại</label>
                                        <input type="text" name="price_sale" placeholder="Nhập giá" value="{{  $product->price_sale }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class=" ">Description:</label>
                                        <textarea class="summernote" name="description" value="{{  $product->description }}"></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Sản phẩm biến thể</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Màu sắc</th>
                                        <th>Size</th>
                                        <th>Image</th>
                                        <th>Số lượng</th>
                                        <th>Gía Niêm Yết</th>
                                        <th>Gía sale</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->variants as $variant)
                                        <tr>
                                            <td style="width: 100px; text-align: center">
                                                <div class="form-ms">
                                                    <p>{{ $variant->size->name }}</p>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <div class="form-ms">
                                                    <p>{{ $variant->color->name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                    <div class="input-container">
                                                        <i class="fa fa-image"></i>
                                                        <input type="file" name="product_variants[{{ $variant->id }}][image]" class="form-control" onchange="showImagePro(event)">
                                                        <img id="img_hinh_anh" src="{{ Storage::url($variant->image) }}" width="70px" alt="Current Image">

                                                    </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="product_variants[{{ $variant->id }}][quantity]" class="form-control" placeholder="Số lượng" value="{{ $variant->quantity }}" style="width: 100px">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="product_variants[{{ $variant->id }}][price_variant]" class="form-control" placeholder="Gía" value="{{ $variant->price_variant }}" style="width: 100px">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="product_variants[{{ $variant->id }}][price_sale_variant]" class="form-control" placeholder="Gía sale" value="{{ $variant->price_sale_variant }}" style="width: 100px">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Đăng</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-title" style="height: 270px">
                            <p><i class="fa fa-pinterest-p"></i> Loại sản phẩm:</p>
                            @php
                                $types = [
                                   'is_best_sale' => 'Bán chạy',
                                  'is_40_sale' => '40%',
                                  'is_hot_online' => 'Hot',
                              ]
                            @endphp
                            <div class="button-container">
                                @foreach($types as $key => $value)
                                    <div class="checkbox checkbox-success checkbox-inline">
                                        <input type="checkbox" value="{{ $key }}" name="{{ $key }}" id="customCheck-{{ $key }}">
                                        <label for="customCheck-{{ $key }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="m-t-sm"> <i class="fa fa-pinterest-p"></i> Trạng thái: </p>
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
                                <input type="text" name="sku" value="{{ strtoupper(\Str::random(8)) }}" placeholder="Mã sản phẩm" class="form-control">
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs m-b" type="submit"><strong>Đăng</strong></button>

                            </div>

                        </div>
                        <div class="ibox-title m-t-md">

                            <p><a href="#">Hình ảnh sản phẩm:</a></p>
                            <div class="input-container">
                                <i class="fa fa-image"></i>
                                <input type="file" name="hinh_anh" class="form-control" onchange="showImagePro(event)">
                                <img id="img_hinh_anh" src="{{ Storage::url($product->img_thumb) }}" alt="" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        <div class="ibox-title m-t-md">
                            <p>
                                <a href="#">Album hình ảnh sản phẩm:</a>
                                <i class="fa fa-arrow-right" style="margin-left: 10px; width: 20px; height: 20px;" type="button" onclick="addNewImage()">+</i>
                            </p>
                            <div id="album-container">
                                @foreach($product->galleries as $index => $image)
                                    {{--                                    @dd($image)--}}
                                    <div class="image-item" id="image-item-{{ $index }}">
                                        <div class="input-container">
                                            <i class="fa fa-image m-t-md"></i>
                                            <input type="file" name="list_hinh_anh[{{ $image->id }}]" class="form-control m-t-md" onchange="updateImage(event, {{ $index }})">
                                            <img id="img_hinh_anh_{{ $index }}" src="{{ Storage::url($image->image) }}" alt="" style="max-width: 100%; height: auto; margin-top: 12px">
                                            <input type="hidden" name="list_hinh_anh[{{ $image->id }}]" value="{{ $image->id }}">
                                        </div>
                                    </div>
                                @endforeach
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

                            <p><i class="fa fa-pinterest-p"></i> <a href="">Tất cả danh mục:</a></p>
                            @foreach($categories as $item)
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox{{ $item->id }}" type="radio" name="danh_muc_id" value="{{ $item->id }}"
                                           @if($product->category_id == $item->id) checked @endif>
                                    <label for="checkbox{{ $item->id }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                            @error('danh_muc_id')
                            <p class="text-danger">{{ $message }}</p>
                             @enderror
        </form>
        <a href="#" id="toggleForm"><i class="fa fa-plus"></i> Thêm mới danh mục</a>
        <div id="categoryFormContainer" style="display: none;">
            <form id="categoryForm" action="{{ route('admins.categories.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="m-l m-t-sm">Tên danh mục:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is_valid @enderror" value="{{ old('name') }}" placeholder="Tên danh mục">
                        @error('name')
                        <p class="text-danger" style="margin-top: 5px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="m-l">Hình ảnh:</label>
                    <div class="col-sm-10">
                        <input type="file" name="cover" class="form-control @error('cover') is_valid @enderror" value="{{ old('cover') }}" onchange="showImage(event)">
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

    </div>

@endsection
@section('js')
    <script>
        function updateImage(event, index) {
            let input = event.target;
            let img = document.getElementById('img_hinh_anh_' + index);

            // Đọc file mới và hiển thị hình ảnh
            let reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }

        function addNewImage() {
            let albumContainer = document.getElementById('album-container');

            // Tạo phần tử mới để hiển thị và tải lên hình ảnh
            let newIndex = albumContainer.children.length;
            let newImageItem = document.createElement('div');
            newImageItem.className = 'image-item';
            newImageItem.id = 'image-item-' + newIndex;

            // Tạo phần tử img và input file
            let inputContainer = document.createElement('div');
            inputContainer.className = 'input-container';

            let icon = document.createElement('i');
            icon.className = 'fa fa-image m-t-md';

            let input = document.createElement('input');
            input.type = 'file';
            input.name = 'list_hinh_anh_new[]';
            input.className = 'form-control m-t-md';
            input.onchange = function(event) {
                updateImage(event, newIndex);
            };

            let img = document.createElement('img');
            img.id = 'img_hinh_anh_' + newIndex;
            img.style = 'max-width: 100%; height: auto; margin-top: 12px';

            // Thêm icon, img và input vào container
            inputContainer.appendChild(icon);
            inputContainer.appendChild(input);
            inputContainer.appendChild(img);

            // Thêm inputContainer vào newImageItem
            newImageItem.appendChild(inputContainer);

            // Thêm newImageItem vào album
            albumContainer.appendChild(newImageItem);
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
    </script>

    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('backend/js/inspinia.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

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
