<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function cod() {
        $params = request()->all();
        
        try {
            if (data_get($params, 'ward') != '-1') {
                $order = Order::create([
                    'payment_type' => "COD",
                    'user_id' => auth()->user()->id,
                    'ward_id' => $params['ward'],
                    'type' => 'Đang xử lý'
                ]);

                foreach (session('cart') as $key => $value) {
                    OrderDetail::create([
                        'products_id' => $key,
                        'order_id' => $order->id,
                        'ward_id' => $order->ward_id
                    ]);
                }

                if($order) {
                    return [
                        'status' => true,
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            return [
                'status' => false,
            ];
        }
        
    }
}
