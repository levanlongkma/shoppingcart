<?php

namespace App\Http\Controllers\Shoping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    public function home()
    {
        return view('shoping.pages.home');
    }
    
    public function blogList()
    {
        return view('shoping.pages.blog.blog_list');
    }

    public function blogSingle()
    {
        return view('shoping.pages.blog.blog_single');

    }

    public function products()
    {
        return view('shoping.pages.shop.products');
    }

    public function productDetails()
    {
        return view('shoping.pages.shop.product_details');
    }

    public function Checkout()
    {
        return view('shoping.pages.shop.checkout');
    }

    public function Cart()
    {
        return view('shoping.pages.shop.cart');

    }

    public function Login()
    {
        return view('shoping.pages.shop.login');

    }

    public function ContactUs()
    {
        return view('shoping.pages.contact_us.contact_us');
    }
}
