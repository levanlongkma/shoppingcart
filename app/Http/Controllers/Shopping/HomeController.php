<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{

    
    public function home()
    {
        return view('shopping.pages.home');
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
