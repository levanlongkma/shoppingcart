<?php

namespace App\Http\Controllers\Shoping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('shoping.pages.home');
    }
}
