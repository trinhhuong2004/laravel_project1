@extends('clients.layouts.index')

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row ec_breadcrumb_inner">
                                        <div class="col-md-6 col-sm-12">
                                            <h2 class="ec-breadcrumb-title">Danh sách đơn hàng</h2>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <ul class="ec-breadcrumb-list">
                                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                                </li>
                                                <li class="ec-breadcrumb-item active">Danh sách đơn hàng</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ec-cart-inner">
                        <div class="row">
                            <div class="table-content cart-table-content container">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Địa chỉ giao hàng</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $order->receiver_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>{{ number_format($order->total_price, 0, '.', '.') }} đ</td>
                                            <td>{{ $order->receiver_address }}</td>
                                            <td>
                                                @switch($order->order_status)
                                                    @case('pending')
                                                        Chờ xử lý
                                                        @break
                                                    @case('confirmed')
                                                        Đã xác nhận
                                                        @break
                                                    @case('preparing')
                                                        Đang chuẩn bị hàng
                                                        @break
                                                    @case('shipping')
                                                        Đang giao hàng
                                                        @break
                                                    @case('delivered')
                                                        Đã hoàn thành
                                                        @break
                                                    @case('cancel')
                                                        Đã hủy
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($order->payment_status)
                                                    @case('unpaid')
                                                        Chưa thanh toán
                                                        @break
                                                    @case('paid')
                                                        Đã thanh toán
                                                        @break
                                                    @default
                                                        Không xác định
                                                @endswitch
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('order.show', $order->id) }}"
                                                   class="btn btn-warning mr-3">View</a>
                                                <form action="{{ route('order.update', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    {{--                                                    @dd($order->pending);--}}
                                                    @if($order->order_status === $pending)
                                                        <input type="hidden" name="cancel" value="1">
                                                        <button type="submit"
                                                                onclick="return confirm('Bạn có muốn hủy đơn hàng không?')"
                                                                class="btn btn-danger">Hủy
                                                        </button>
                                                    @elseif($order->order_status === $shipping)
                                                        <input type="hidden" name="delivered" value="1">
                                                        <button type="submit"
                                                                onclick="return confirm('Xác nhận đã nhận hàng?')"
                                                                class="btn btn-success">Đã nhận hàng
                                                        </button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
