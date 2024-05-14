<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('login.index');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email sai định dạng',
            'password.required' => 'Mật khẩu là bắt buộc',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/account')->with('success','Đăng nhập đã thành công');
            } else {
   
                return redirect()->intended('/home');
            }
        }

        // Xác thực không thành công, chuyển hướng về form đăng nhập với thông báo lỗi
        return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
