<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(!auth()->guard('admin')->attempt($credentials)){
            return redirect()->back()->withErrors(['emamil'=>'invalid credentials'])->withInput();
        }
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
