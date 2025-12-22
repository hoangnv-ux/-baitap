<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\App\Http\Services\Admin\AdminService;


class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth::admin',['except'=>['login']]);
    }

    public function login(Request $request){
        $inforlogin = $request->only('email','password');
        $token = auth('admin')->attempt($inforlogin);

        if(!$token){
            return redirect()->withErrors(['login'=>'invalid inforlogin'])->withInput();
        }

        $cookie = cookie('admin_token',$token,60*24,null,null,null,true,false,null);

        return redirect()->route('admin.dashboard')->cookie($cookie);


    }
    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }

}
