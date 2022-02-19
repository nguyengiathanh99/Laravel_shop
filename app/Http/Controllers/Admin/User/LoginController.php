<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        return view('admin.user.login',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }
    public function store(Request $request) {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ],$request->input('remember'))){
            return redirect()->route('admin')->with('success','Đăng nhập thành công');
        }
        Session::flash('error','Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
}
