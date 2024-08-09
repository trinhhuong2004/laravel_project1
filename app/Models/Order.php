<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // order
    const ORDER_STATUS = [
        'pending' => 'Chờ xác nhận',
        'confirmed' => 'Đã Xác Nhận',
        'preparing' => 'Đang Chuẩn Bị Hàng',
        'shipping' => 'Đang Giao Hàng',
        'delivered' => 'Đã Giao Hàng',
        'cancel' => 'Hủy Đơn Hàng'
    ];
    // payment
    const PAYMENT_STATUS = [
        'paid' => 'Đã Thanh Toán',
        'unpaid' => 'Chưa Thanh Toán'
    ];
    const PENDING = 'pending';
    const CONFIRMED = 'confirmed';
    const PREPARING = 'preparing';
    const SHIPPING = 'shipping';
    const DELIVERED = 'delivered';
    const CANCEL = 'cancel';

    const PAID = 'paid';
    const UNPAID = 'unpaid';

    protected $fillable = [
        'user_id',
        'user_email',
        'user_name',
        'user_address',
        'user_phone',
        'receiver_email',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'note',
        'order_status',
        'payment_status',
        'total_price',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
