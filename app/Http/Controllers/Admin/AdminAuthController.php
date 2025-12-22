<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['except'=>['login']]);
    }

    public function login(UserRequest $request)
    {

        $credentials = $request->only('email', 'password');

        $token = auth('admin')->attempt($credentials);


        if (!$token) {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
        }

        $cookie = cookie('admin_token', $token, 60 * 24,null,null,null,true,false,null);

        return redirect()->route('admin.dashboard')->cookie($cookie);
    }

    public function logout()
    {
        auth('admin')->logout();

        return redirect()->route('admin.login');
    }

}


?>
