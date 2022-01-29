<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckoutValidator;
use App\Http\Requests\Shopping\CheckoutValidator as ShoppingCheckoutValidator;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Ward;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function createOrder (ShoppingCheckoutValidator $request)
    {
        $param = $request->all();


        
    }

    public function createOrderDetail (ShoppingCheckoutValidator $request)
    {
        $param = $request->all();
        
        $city = City::where('matp', $param['city'])->first();
        $district = District::where('maqh', $param['district'])->first();
        $ward = Ward::where('id', $param['ward'])->first();
        
        $paramID = auth()->id();
        $string = date("YmdHis");
        
        $order_id = $string."-".$paramID;
        
        DB::beginTransaction();
        
        try {

            if(data_get($param,'ward') != null) {
                $order = Order::create([
                    'order_id'=>$order_id,
                    'user_id'=>auth()->id(),
                    'payment_type'=>"COD",
                    'checkout_status'=> 0,
                    'details_address'=>$param['details_address'],
                    'note_shipping'=>$param['note_shipping'],
                    'phone_number'=>$param['phone_number'],
                    'ward'=>$ward->name,
                    'city'=>$city->name,
                    'district'=>$district->name,
                    'name'=>$param['name'],
                    'subtotal'=>$param['subtotal'],
                    'created_at'=>now()
                ]);
            }

            if(session('cart') != null) {
                
                foreach (session('cart') as $key => $value) {
                    
                    $order_detail = OrderDetail::create([
                        'products_id' => $key,
                        'name' => Product::where('id',$value['id'])->first()->name,
                        'user_id'=> auth()->id(),
                        'quantity'=> $value['quantity'],
                        'order_id'=>$order->order_id,
                        'total'=>$value['quantity']*$value['price'],
                        'updated_at'=>now()
                    ]);
                }
                
            }

            
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack(); 
            
            return redirect()->back()->with('error_checkout', "Đặt hàng thất bại");
        }

        return redirect()->route('shopping.home')->with('success_checkout',"Đặt hàng thành công! Mời bạn tiếp tục xem hàng");
        

    }
// Dùng cái này để insert vào 2 bảng order và order detail
   
}
