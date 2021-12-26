<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm() 
    {
        return view('backend.auth.login');
    }

    public function login(LoginValidator $request)
    {
        $params = $request->all();

        if (Auth::guard('admin')->attempt([
            'email' => data_get($params, 'email'),
            'password' => data_get($params, 'password')
        ])) {
            session()->flash('success', 'Welcome back, admin!');
            return redirect()->route('admin.dashboard');
        }
        request()->session()->flash('message', 'Login fail, please check your email and password again');
        return Redirect::back();
    }

    public function logOut()
    {
        if(Auth::guard('admin')->check()){
            
            Auth::guard('admin')->logout();
            request()->session()->flash('message', 'Logout success!');
            return redirect()->route('admin.login');
        }
    }
}
