<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Product;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home()
    {
        $slides = Slide::all();
        $categories = Category::all();
        $products = Product::with('productImages')->get();

        // $products = [
        //     [
        //         'name' => 'x1',
        //         'type' => 1
        //     ],
        //     [
        //         'name' => 'x1',
        //         'type' => 2
        //     ]
        // ];

        // foreach ($products as $item) {
        //     if ($item['type'] == Product::QUANDUI) {
        //         dd(config('config.product_type.' . $item['type']));

        //     }
        // }
        
        return view('shopping.pages.home', compact('slides', 'categories', 'products'));
    }
    
    public function addToCart($id)
    {
        $product = Product::find($id);
        $product_image = Product::find($id)->productImages()->first();
        
        $cart = session()->get('cart');
        

        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image"=> $product_image,
        ];

        session()->put('cart', $cart);
        session()->flash('success_add', "Product add to cart success");
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function productsOnCategory($id)
    {
        try {
            $products = Product::where('category_id', $id)->get();
            return [
                'status' => true,
                'products' => $products
            ];
        } catch (Exception $e) {
            Log::error($e);
            return [
                'status' => false,
            ];
        }
    }

    public function blogList()
    {
        return view('shopping.pages.blog.blog-list');
    }

    public function blogSingle()
    {
        return view('shopping.pages.blog.blog-single');

    }

    public function products()
    {
        return view('shopping.pages.shop.products');
    }

    public function productDetails()
    {
        return view('shopping.pages.shop.product-details');
    }

    public function Checkout()
    {
        $cities = City::with('districts')->get();
        
        return view('shopping.pages.shop.checkout', compact('cities'));
    }

    public function Cart()
    {
        return view('shopping.pages.shop.cart');

    }

    public function Login()
    {
        return view('shopping.pages.shop.login');

    }

    public function ContactUs()
    {
        return view('shopping.pages.contact_us.contact-us');
    }
}
