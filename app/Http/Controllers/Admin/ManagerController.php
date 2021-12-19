<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function managerAdmins() 
    {
        $active = "managerAdmins";
        return view('backend.manager.managerAdmins', compact('active'));
    }
    public function managerUsers() 
    {
        $active = "managerUsers";
        return view('backend.manager.managerUsers', compact('active'));
    }
}
