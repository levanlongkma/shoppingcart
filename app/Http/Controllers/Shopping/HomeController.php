<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{

    
    public function home()
    {
        $slides = Slide::all();
        $categories = Category::all();
        $products = Product::with('productImages')->get();
        return view('shopping.pages.home', compact('slides', 'categories', 'products'));
    }
    
    public function addToCart(Request $request)
    {
        $data = $request->all();
        print_r($data);
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
        return view('shopping.pages.shop.checkout');
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
