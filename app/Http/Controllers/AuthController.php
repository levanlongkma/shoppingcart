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
    public function register(Request $request)
    {
        $confirmation_code = time().uniqid(true);
        
        $data = $request->all();
        $users = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'confirmation_code' => $confirmation_code,
            'confirmed' => 0
        ]);

        $data['confirmation_code'] = $users->confirmation_code;

        Mail::send('emails.verify', $data, function($message) use ($data){
            $message->from('no-reply@site.com', "Dear");
                $message->subject("Verify Account");
                $message->to($data['email']);
        });

        $request->session()->flash('success', "Vui lòng xác nhận tài khoản email");

        return redirect()->back();
    }

    public function verify(Request $request, $code)
    {
        $user = User::where('confirmation_code', $code);

        if($user->count() > 0){
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $request->session()->flash('success_verify', "Xác nhận thành công, Mời bạn đăng nhập");
        }else{
            $request->session()->flash('error_verify', "Xác nhận không thành công");
        }

        return redirect()->route('shopping.login_post');
    }

    public function logIn(Request $request)
    {

        if (!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'confirmed'=>1])) {

            $request->session()->flash('error_login', "Vui lòng kiểm tra lại mật khẩu hoặc email !");
            return redirect()->back();
        }
        
        return redirect()->route('shopping.home');

        $validated = $request->validate([
            'email_login' => 'required',
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
