<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function managerAdmins() 
    {
        $active = "managerAdmins";
        return view('backend.manager.admins.index', compact('active'));
    }
    public function managerUsers() 
    {
        $active = "managerUsers";
        return view('backend.manager.users.index', compact('active'));
    }
    public function createAdmin() {
        return view('backend.manager.admins.create');
    }
    
}
