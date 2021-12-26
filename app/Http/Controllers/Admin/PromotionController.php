<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function promotions() 
    {
        $active = "promotions";
        return view('backend.promotions.index',compact('active'));
    }
}
