<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function products() 
    {
        $active = "products";
        return view('backend.products.index', compact('active'));
    }
}
