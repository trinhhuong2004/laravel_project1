@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Chi tiết sản phẩm</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Bảng điều khiển</a>
                </li>
                <li>
                    <a href="{{ route('admins.products.index') }}">Sản phẩm</a>
                </li>
                <li class="active">
                    <strong>Chi tiết sản phẩm</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="box-content">
                            <h3>Chi tiết sản phẩm</h3>
                        </div>
                        <hr>
                        <table class="table table-stripped mb-0" data-page-size="15">
                            <thead >
                            <th ><b style="margin-left: 40px">Thông tin sản phẩm</b></th>
                            <th ><b style="margin-left: 40px">Thông tin biến thể</b></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <ul style="position: relative">
                                        <li>Tên sản phẩm  : <b>{{ $product->name }}</b></li>
                                        <li>Danh mục  : <b>{{ $product->category->name }}</b></li>
                                        <li>Mã : <b>{{ $product->sku }}</b></li>
                                        <li>Giá niêm yết: <b>{{ number_format($product->price, 2, '.', ',') }}</b></li>
                                        <li>Giá khuyến mại: <b>{{ number_format($product->price_sale, 2, '.', ',') }}</b></li>
                                        <li>Mô tả : <b>{{ $product->description }}</b></li>
                                        <li>Is Best Sale: <b>{{ $product->is_best_sale ? 'Yes' : 'No' }}</b></li>
                                        <li>Is 40% Sale: <b>{{ $product->is_40_sale ? 'Yes' : 'No' }}</b></li>
                                        <li>Is Hot Online: <b>{{ $product->is_hot_online ? 'Yes' : 'No' }}</b></li>
                                        <li> Ảnh đại diện: </li><br> <img src="{{ Storage::url($product->img_thumb) }}" alt="{{ $product->name }}" style="max-width: 100px; height: 70px; position: absolute; top: 120px; left: 60%">
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($product->variants as $variant)
                                            <li>
                                                Kích thước: <b>{{ $variant->size->name ?? 'N/A' }}</b>, <!-- Truy cập tên kích thước -->
                                                Màu sắc: <b>{{ $variant->color->name ?? 'N/A' }}</b>, <!-- Truy cập tên màu sắc -->
                                                Số lượng: <b>{{ $variant->quantity }}</b>,
                                                Hình ảnh: <img src="{{ Storage::url($variant->image) }}" alt="Biến thể" style="max-width: 70px; height: 30px">
                                            </li>
                                        @endforeach

                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="box-content">
                            <h3>Sản phẩm của đơn hàng</h3>
                        </div>
                        <hr>
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>Album ảnh</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>   @foreach($product->galleries as $gallery)
                                            <img src="{{ Storage::url($gallery->image) }}" alt="Gallery Image" style="max-width: 100px; height: 70px">
                                        @endforeach</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
