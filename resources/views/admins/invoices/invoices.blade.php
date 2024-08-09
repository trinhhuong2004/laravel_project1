<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
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
    <div class="col-lg-2"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="box-content" style="display: flex; justify-content: space-between">
                        <h3>Thông tin chi tiết đơn hàng</h3>
                        <a href="{{ route('invoices', $invoices->id) }}" style="padding-top: 10px">
                            <i class="fa fa-file"> Xuất hóa đơn</i>
                        </a>
                    </div>
                    <hr>
                    <table class="table table-stripped mb-0" data-page-size="15">
                        <thead>
                        <tr>
                            <th>Thông tin tài khoản đặt hàng</th>
                            <th>Thông tin người nhận hàng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <ul>
                                    <li>Tên tài khoản: <b>{{ $invoices->user_name }}</b></li>
                                    <li>Email: <b>{{ $invoices->user_email }}</b></li>
                                    <li>Số điện thoại: <b>{{ $invoices->user_phone }}</b></li>
                                    <li>Địa chỉ: <b>{{ $invoices->user_address }}</b></li>
                                    <li>Tài khoản: <b>{{ $invoices->user->role }}</b></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Tên người nhận: <b>{{ $invoices->receiver_name }}</b></li>
                                    <li>Email người nhận: <b>{{ $invoices->receiver_email }}</b></li>
                                    <li>Số điện thoại người nhận: <b>{{ $invoices->receiver_phone }}</b></li>
                                    <li>Địa chỉ: <b>{{ $invoices->receiver_address }}</b></li>
                                    <li>Ghi chú: <b>{{ $invoices->note }}</b></li>
                                    <li>Trạng thái thanh toán:
                                        @switch($invoices->payment_status)
                                            @case('unpaid')
                                                Chưa thanh toán
                                                @break
                                            @case('paid')
                                                Đã thanh toán
                                                @break
                                            @default
                                                Không xác định
                                        @endswitch
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @foreach ($invoices->orderItems as $item)
                            <tr>
                                <td colspan="2">
                                    <ul>
                                        <li>Tiền hàng: {{ number_format($item->product_price_sale_variant, 0, '.', ',') }} đ</li>
                                        <li>Số lượng: {{ $item->quantity }}</li>
                                        <li>Tổng tiền: {{ number_format($item->product_price_sale_variant * $item->quantity, 0, '.', ',') }} đ</li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
