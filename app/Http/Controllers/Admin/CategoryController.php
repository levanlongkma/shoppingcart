<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categories() 
    {
        $active = "categories";
        return view('backend.categories.index', compact('active'));
    }
}
