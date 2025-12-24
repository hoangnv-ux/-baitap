<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{

    public function login(Request $request){
        $credentials = $request->only('email','password');
        $credentials['is_active'] = true;

        if(!auth()->guard('user')->attempt($credentials)){
            return redirect()->back()->withErrors(['email'=>'invalid credentials'])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('user.dashboard');

    }

    public function logout(Request $request){
        auth()->guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
