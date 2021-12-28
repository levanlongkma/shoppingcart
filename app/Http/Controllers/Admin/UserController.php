<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller 
{
    public function index() {
        $active = 'users';
        $search = request()->input('search') ?? "";
        $users = User::where('name', 'LIKE', "%{$search}%")->paginate(10);
        // dd($users);
        return view('backend.users.index', compact('users', 'search', 'active'));
    }
}
