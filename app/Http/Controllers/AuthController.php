<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signUp( Request $request )
    {
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = User::create($request->input());
        Auth::login($user);

        return redirect()->route('shopping.home');
    }

    public function logIn(Request $request)
    {
        $validated = $request->validate([
            'name_login'=>'required',
            'password_login'=>'required',
        ]);

    if(Auth::attempt(['name'=>$request->input('name'), 'password'=>$request->input('password')]))
    {
        return redirect()->route('shopping.home');
    }
        $request->session()->flash('error','Đăng nhập thất bại');

        return redirect('/login');
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->route('shopping.home');
    }
}
