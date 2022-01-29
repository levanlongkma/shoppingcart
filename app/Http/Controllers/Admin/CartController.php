<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->paginate(4);

        return view('backend.orders.order', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::where('order_id', $id )->first();
        $order_id = $order->order_id;
        
        $orderDetails = OrderDetail::where('order_id', $order_id)->get();
        
        return view('backend.orders.order-detail', compact('order', 'orderDetails'));
    }

    public function delete($id)
    {
        $isDeleted = Order::where('id', $id)->delete();

        if($isDeleted) {
            return ['status' => true];
        }

        return ['status' => false];
        
    }

    public function confirm($id)
    {
        $confirm = Order::where('id', $id);

        $isConfirm = $confirm->update([
            'checkout_status' => 1
        ]);

        if($isConfirm){
            return ['status' => true];
        }

        return ['status' => false];
    }
}
