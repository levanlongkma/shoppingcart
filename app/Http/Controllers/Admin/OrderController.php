<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders() 
    {
        $active = "orders";
        return view('backend.orders.index', compact('active'));
    }
}
