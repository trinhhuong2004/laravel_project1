@extends('clients.layouts.index')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="wrapper wrapper-content container mt-4">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="box-content bg-light border">
                                    <h3 class="p-2 text-secondary">Thông tin chi tiết đơn hàng</h3>
                                </div>
                                <hr>
                                <table class="table table-stripped mb-0" data-page-size="15">
                                    <thead>
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
                                                <li>Trạng thái đơn hàng:
                                                    <b>{{ $order_status[$order->order_status] }}</b></li>
                                                <li>Trạng thái thanh toán:
                                                    <b>{{ $order_payment[$order->payment_status] }}</b></li>

                                                @foreach ($order->orderItems as $item)
                                                    <li>Tiền
                                                        hàng: {{ number_format($item->product_price_sale_variant, 0, '.', ',') }}
                                                        đ
                                                    </li> <!-- Đơn giá -->
                                                    <li>Số lượng: {{ $item->quantity }}</li> <!-- Số lượng -->
                                                    <li>Tổng
                                                        tiền: {{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }}
                                                        đ
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

                <div class="row mt-4">

                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="box-content bg-light border">
                                    <h3 class="p-2 text-secondary">Sản phẩm của bạn</h3>
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
                                                <img src="{{ Storage::url($item->product_img_thumb) }}" alt=""
                                                     style="width: 100px; height: auto;">

                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->variant_color_name }}</td>
                                            <td>{{ $item->variant_size_name }}</td>

                                            <td>{{ number_format($item->product_price_sale_variant, 0, '.', ',') }}đ
                                            </td> <!-- Đơn giá -->
                                            <td>{{ $item->quantity }}</td> <!-- Số lượng -->
                                            <td>{{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }}
                                                đ
                                            </td> <!-- Thành tiền -->
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                {{--                    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">--}}
                {{--                        <div class="container">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-12">--}}
                {{--                                    <div class="row ec_breadcrumb_inner">--}}
                {{--                                        <div class="col-md-6 col-sm-12">--}}
                {{--                                            <h2 class="ec-breadcrumb-title">Chi tiết đơn hàng</h2>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-md-6 col-sm-12">--}}
                {{--                                            <ul class="ec-breadcrumb-list">--}}
                {{--                                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>--}}
                {{--                                                <li class="ec-breadcrumb-item active">Chi tiết đơn hàng</li>--}}
                {{--                                            </ul>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                    <div class="ec-cart-inner">--}}
                {{--                        <div class="row">--}}
                {{--                            <table class="table">--}}
                {{--                                <thead>--}}
                {{--                                <tr>--}}
                {{--                                    <th>Mã đơn hàng</th>--}}
                {{--                                    <th>Tên khách hàng</th>--}}
                {{--                                    <th>Email khách hàng</th>--}}
                {{--                                    <th>Địa chỉ giao hàng</th>--}}
                {{--                                    <th>Điện thoại</th>--}}
                {{--                                    <th>Ghi chú</th>--}}
                {{--                                    <th>Tổng tiền</th>--}}
                {{--                                    <th>Trạng thái đơn hàng</th>--}}
                {{--                                    <th>Trạng thái thanh toán</th>--}}
                {{--                                    <th>Ngày đặt</th>--}}
                {{--                                </tr>--}}
                {{--                                </thead>--}}
                {{--                                <tbody>--}}
                {{--                                <tr>--}}
                {{--                                    <td>{{ $order['id'] }}</td>--}}
                {{--                                    <td>{{ $order['user_name'] }}</td>--}}
                {{--                                    <td>{{ $order['user_email'] }}</td>--}}
                {{--                                    <td>{{ $order['receiver_address'] }}</td>--}}
                {{--                                    <td>{{ $order['receiver_phone'] }}</td>--}}
                {{--                                    <td>{{ $order['note'] }}</td>--}}
                {{--                                    <td>{{ number_format($order['total_price'], 0, '.', ',') }} đ</td>--}}
                {{--                                    <td>{{ ucfirst($order['order_status']) }}</td>--}}
                {{--                                    <td>{{ ucfirst($order['payment_status']) }}</td>--}}
                {{--                                    <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y H:i:s') }}</td>--}}
                {{--                                </tr>--}}
                {{--                                </tbody>--}}
                {{--                            </table>--}}

                {{--                            <!-- Nếu bạn có thông tin chi tiết sản phẩm, bạn có thể hiển thị ở đây -->--}}
                {{--                            <!-- Ví dụ: -->--}}
                {{--                            <h3>Chi tiết sản phẩm</h3>--}}
                {{--                            <!-- Giả sử bạn có thông tin chi tiết sản phẩm, bạn sẽ cần lặp qua danh sách chi tiết sản phẩm -->--}}
                {{--                            <!-- Dưới đây là ví dụ nếu có dữ liệu chi tiết sản phẩm: -->--}}
                {{--                            <table class="table">--}}
                {{--                                <thead>--}}
                {{--                                <tr>--}}
                {{--                                    <th>Hình ảnh</th>--}}
                {{--                                    <th>Mã sản phẩm</th>--}}
                {{--                                    <th>Đơn giá</th>--}}
                {{--                                    <th>Số lượng</th>--}}
                {{--                                    <th>Thành tiền</th>--}}
                {{--                                </tr>--}}
                {{--                                </thead>--}}
                {{--                                <tbody>--}}
                {{--                                @foreach ($order->orderItems as $item)--}}
                {{--                                    <tr>--}}
                {{--                                        <td>--}}
                {{--                                            <!-- Hiển thị hình ảnh sản phẩm -->--}}
                {{--                                            <img src="{{ Storage::url($item->product_img_thumb) }}" alt="" style="width: 100px; height: auto;">--}}
                {{--                                        </td>--}}
                {{--                                        <td>{{ $item->product_sku }}</td> <!-- Mã sản phẩm -->--}}
                {{--                                        <td>{{ number_format($item->product_price_sale_variant, 0, '.', ',') }} đ</td> <!-- Đơn giá -->--}}
                {{--                                        <td>{{ $item->quantity }}</td> <!-- Số lượng -->--}}
                {{--                                        <td>{{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }} đ</td> <!-- Thành tiền -->--}}
                {{--                                    </tr>--}}
                {{--                                @endforeach--}}
                {{--                                </tbody>--}}
                {{--                            </table>--}}

                {{--                        </div>--}}
                {{--                    </div>--}}
            </div>
        </div>
    </div>
    </div>
@endsection
