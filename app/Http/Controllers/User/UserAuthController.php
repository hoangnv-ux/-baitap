<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user',['except' => ['login']]);
    }

    public function login(Request $request){
        $credentials = $request->only('email','password');

        if(!auth('user')->attempt($credentials)){
            return redirect()->back()->withErrors(['email'=>__('auth.failed')])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request){

        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');



    }
}
