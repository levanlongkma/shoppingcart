<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $active = "orders";
        $query = DB::table('orders');

        if (request()->input('search')) {
            $query->where('order_id', 'LIKE', '%'.request()->get('search').'%');
        }

        if (request()->input('customer_id')) {
            $query->where('user_id', 'LIKE', '%'.request()->get('customer_id').'%');
        }

        $orders = $query->paginate(4);
        return view('backend.orders.index', compact(['orders','active']));
    }

    public function orderDetail($id)
    {
        $active = "orders";
        $order = Order::where('order_id', $id )->first();
        $order_id = $order->order_id;
        
        $orderDetails = OrderDetail::where('order_id', $order_id)->get();
        
        return view('backend.orders.view', compact('order', 'orderDetails', 'active'));
    }

    public function delete()
    {
        $isDeleted = Order::where('id', request()->input('id'))->delete();

        if($isDeleted) {
            return ['status' => true];
        }

        return ['status' => false];
        
    }

    public function confirm()
    {
        $isConfirm = Order::where('id', request()->input('id'))
                            ->update([
                                'checkout_status' => 1
                            ]);

        if($isConfirm){
            return ['status' => true];
        }

        return ['status' => false];
    }
}