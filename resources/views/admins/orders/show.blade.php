
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection
@section('content')
    {{--    @dd($data)--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Danh sách sản phẩm</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Sản phẩm</a>
                </li>
                <li class="active">
                    <strong>Đơn hàng chi tiết</strong>
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
                        <div class="box-content" style="display: flex; justify-content: space-between">
                            <h3>Thông tin chi tiết đơn hàng</h3>
                            <a href=" {{ route('invoices',$order->id) }}" style="padding-top: 10px"><i class="fa fa-file"> Xuất hóa đơn</i></a>
                        </div>
                        <hr>
                        <table class="table table-stripped mb-0" data-page-size="15">
                                <thead >
                                    <th>Thông tin tài khoản đặt hàng</th>
                                    <th>Thông tin người nhận hàng</th>
                                </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>Tên tài khoản: <b>{{ $order->user_name }}</b></li>
                                                <li>Email: <b>{{ $order->user_email }}</b></li>
                                                <li>Số điện thoại: <b>{{ $order->user_phone }}</b></li>
                                                <li>Địa chỉ: <b>{{ $order->user_address }}</b></li>
                                                <li>Tài khoản: <b>{{ $order->user->role }}</b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Tên người nhận: <b>{{ $order->receiver_name }}</b></li>
                                                <li>Email người nhận: <b>{{ $order->receiver_email }}</b></li>
                                                <li>Số điện thoại người nhận: <b>{{ $order->receiver_phone }}</b></li>
                                                <li>Địa chỉ: <b>{{ $order->receiver_address }}</b></li>
                                                <li>Ghi chú: <b>{{ $order->note }}</b></li>
                                                <li>Trạng thái đơn hàng: <b>{{ $order_status[$order->order_status] }}</b></li>
                                                <li>Trạng thái thanh toán: <b>{{ $order_payment[$order->payment_status] }}</b></li>

                                                @foreach ($order->orderItems as $item)
                                                <li>Tiền hàng: {{ number_format($item->product_price_sale_variant, 0, '.', ',') }} đ</li> <!-- Đơn giá -->
                                                <li>Số lượng: {{ $item->quantity }}</li> <!-- Số lượng -->
                                                <li>Tổng tiền: {{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }} đ</li>
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Màu sắc</th>
                                <th>Size</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_sku }}</td> <!-- Mã sản phẩm -->
                                    <td>
                                        <!-- Hiển thị hình ảnh sản phẩm -->
                                        <img src="{{ Storage::url($item->product_img_thumb) }}" alt="" style="width: 100px; height: auto;">

                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->variant_color_name }}</td>
                                    <td>{{ $item->variant_size_name }}</td>

                                    <td>{{ number_format($item->product_price_sale_variant, 0, '.', ',') }} đ</td> <!-- Đơn giá -->
                                    <td>{{ $item->quantity }}</td> <!-- Số lượng -->
                                    <td>{{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }} đ</td> <!-- Thành tiền -->
                                </tr>
                            @endforeach
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
{{--<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>--}}

{{--<script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script>--}}

<!-- FooTable -->

