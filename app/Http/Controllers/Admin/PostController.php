<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function posts() 
    {
        $active = "posts";
        return view('backend.posts.index', compact('active'));
    }
}
