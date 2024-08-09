<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirm;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller
{
    public function generateInvoice($id)
    {
        $order = Order::find($id); // Lấy dữ liệu hóa đơn từ database
        $data = ['invoices' => $order];
//        dd($data);
        $pdf = PDF::loadView('admins.invoices.invoices', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('invoices.pdf');
    }
    public function myCart()
    {
        // Lấy tất cả đơn hàng của người dùng đã đăng nhập
        $orders = Auth::user()->orders;
        $order_status = Order::ORDER_STATUS;
        $pending = Order::PENDING;
        $shipping = Order::SHIPPING;
//        dd($orders->toArray());
        // Truyền dữ liệu đến view
        return view('clients.pages.orders.index', compact('orders', 'order_status', 'pending', 'shipping'));
    }
    public function showCart($id)
    {
        // Lấy đơn hàng từ cơ sở dữ liệu cùng với các chi tiết của đơn hàng
        $order = Order::query()->findOrFail($id);
        //dd($order->toArray());
        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('order.list')->with('error', 'Đơn hàng không tồn tại.');
        }
        $order_status = Order::ORDER_STATUS;
        $order_payment = Order::PAYMENT_STATUS;
        // Trả về view với dữ liệu đơn hàng
        return view('clients.pages.orders.show', compact('order', 'order_status', 'order_payment'));
    }
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);
        DB::beginTransaction(); // Bắt đầu transaction
        try {
            if ($request->has('cancel')){
                $order->update(['order_status' => Order::CANCEL]);
            } elseif ($request->has('delivered')){
                $order->update(['order_status' => Order::DELIVERED]);
            }
            DB::commit(); // Commit transaction
            return redirect()->back()->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction nếu có lỗi
            // Log lỗi hoặc xử lý khác
            return redirect()->back()->with('error', 'Order update failed: ' . $e->getMessage());
        }
    }


    public function add(OrderRequest $request)
    {
//        dd($request->all());
        // Kiểm tra tài khoản đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        try {
            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $request->userId,
                'user_email' => $request->user_email,
                'user_name' => $request->user_name,
                'user_address' => $request->user_address,
                'user_phone' => $request->user_phone,
                'receiver_email' => $request->receiver_email,
                'receiver_name' => $request->receiver_name,
                'receiver_address' => $request->receiver_address,
                'receiver_phone' => $request->receiver_phone,
                'note' => $request->note,
                'total_price' => $request->totalAmount,
            ]);

            // Tạo order item
            foreach (json_decode($request->productVariants) as $item) {
//                dd($item);
                $item->order_id = $order->id;
                OrderItem::query()->create((array) $item);

                // Xóa sản phẩm trong giỏ hàng
                CartItem::join('carts', 'carts.id', '=', 'cart_items.cart_id')
                    ->where([
                        'product_variant_id' => $item->product_variant_id,
                        'carts.user_id' => $request->userId
                    ])->delete();
            }
//            dd($order->toArray());
//            dd($order->receiver_email);
            Mail::to($order->receiver_email)->queue(new OrderConfirm($order));
            return redirect()->route('checkout.bill')->with('success', 'Đặt hàng thành công');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->route('order.list')->with('error', 'Đặt hàng thất bại: ' . $exception->getMessage());
        }
    }
    public function showBill()
    {
        // Lấy đơn hàng mới nhất của người dùng hiện tại
        $order = Order::where('user_id', auth()->id())->latest()->first();

        // Lấy các sản phẩm trong đơn hàng
        $orderItems = OrderItem::where('order_id', $order->id)->get();
//        dd($orderItems->toArray());
        return view('clients.pages.bill', compact('order', 'orderItems'));
    }

}
