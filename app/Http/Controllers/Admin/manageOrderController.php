<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class manageOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách đơn hàng';
        $listOrder = Order::query()->orderByDesc('id')->get();
        $order_status = Order::ORDER_STATUS;
        $type_canel_order = Order::CANCEL;
//        dd($listOrder);
        return view('admins.orders.index', compact('title','listOrder', 'order_status', 'type_canel_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin chi tiết đơn hàng";
        $order = Order::query()->findOrFail($id);
        //dd($order->toArray())
        $order_status = Order::ORDER_STATUS;
        $order_payment = Order::PAYMENT_STATUS;

        return view('admins.orders.show', compact('title', 'order','order_status', 'order_payment' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);
        $currentStatus = $order->order_status;
        $newStatus = $request->input('order_status');
        $status = array_keys(Order::ORDER_STATUS);

        // Kiểm tra nếu đơn hàng đã hủy thì không được thay đổi trạng thái nữa
        if($currentStatus === Order::CANCEL){
            return redirect()->route('admins.orders.index')->with('error', 'Đơn hàng đã bị hủy không thể thay đổi trạng thái');
        }
        // Kiểm tra nếu trạng thái mới không đc nằm sau trạng thái hiện tại
        if(array_search($newStatus, $status) < array_search($currentStatus, $status)){
            return redirect()->route('admins.orders.index')->with('error', 'Không thể cập nhật ngược lại trạng thái');
        }
        $order->order_status = $newStatus;
        $order->save();
        return redirect()->route('admins.orders.index')->with('success', 'Cập nhật trạng thái thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::query()->findOrFail($id);

        // So sánh trạng thái đơn hàng với giá trị Order::CANCEL
        if ($order->order_status === Order::CANCEL) {
            // Xóa các mục hàng liên quan
            $order->orderItems()->delete();
            // Xóa đơn hàng
            $order->delete();
            return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
        } else {
            return redirect()->back()->with('error', 'Không thể xóa đơn hàng');
        }
    }

}
