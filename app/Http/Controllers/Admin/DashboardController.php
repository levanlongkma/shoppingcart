<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $active = "dashboard";
        return view('backend.dashboard', compact('active'));
    }
}
