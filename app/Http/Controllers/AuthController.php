<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $values = $request->input();
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::create($request->input());

        Mail::to($values['email'])->send(new SendMail($values));
        
        $request->session()->flash('success', "Check your mail !!!");
        return redirect()->back();
    }

    public function logIn(Request $request)
    {

        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {

            return redirect()->route('shopping.home');
        }

        $validated = $request->validate([
            'name_login' => 'required',
            'password_login' => 'required',
        ]);

        $request->session()->flash('error', 'Login failed');

        return redirect()->route('shopping.login');
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->route('shopping.home');
    }
}
