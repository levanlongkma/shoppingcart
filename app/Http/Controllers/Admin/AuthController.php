<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm() 
    {
        return view('backend.account.login');
    }
    public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember') == "on" ? True : False;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)) {
            $request->session()->flash('success', 'Welcome back, admin!');
            return redirect('admin/dashboard');
        }
        else {
            $request->session()->flash('message', 'Login fail, please check your email and password again');
            return redirect('admin/login');
        }
    }
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->flash('message', 'Logout success!');
        return redirect('/admin/login');
    }
}
