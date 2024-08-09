@component('mail::message')
    # Xác nhận đơn hàng

    Xin chào {{ $order->receiver_name }},

    Cảm ơn bạn đã đặt hàng của chúng tôi. Đây là thông tin đơn hàng của bạn:

    @component('mail::table')
        |           Tham số           |             Giá trị           |
        | --------------------------- | ----------------------------- |
        | **Mã đơn hàng**             | {{ $order->id }}              |
        | **Tên người nhận**          | {{ $order->receiver_name }}   |
        | **Địa chỉ người nhận**      | {{ $order->receiver_address }}|
        | **Số điện thoại người nhận**| {{ $order->receiver_phone }}  |
        | **Email người nhận**        | {{ $order->receiver_email }}  |
        | **Ghi chú**                 | {{ $order->note }}            |
        | **Tổng tiền**                | {{ number_format($order->total_price, 0, ',', '.') }} VND |
    @endcomponent

@endcomponent
