<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(!auth('admin')->attempt($credentials)){
            return back()->withErrors(['message' => 'invalid credentials'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');

    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->generateToken();

        return redirect()->route('admin.login');
    }
}
