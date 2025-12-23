<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\App\Http\Services\Admin\AdminService;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Container\Attributes\Auth;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth::admin',['except'=>['login']]);
    }

    public function login(UserRequest $request){

        $inforlogin = $request->validated();

        if(!auth('admin')->attempt($inforlogin)){
            return redirect()->back()
                ->withErrors(['email'=>__('auth.failed')])
                ->withInput();
        }
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');

    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->validate();
        $request->session()->regenerate();



        return redirect()->route('admin.login');
    }

}
