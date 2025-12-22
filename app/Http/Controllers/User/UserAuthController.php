<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\User\AuthService;
use App\Http\Requests\User\UserRequest;


class UserAuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth:user', [
            'except' => [
                'login',
            ]
        ]);
    }

    /**
     * @param  \App\Http\Requests\User\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserRequest $request)
    {
        $credentials = $request->validated();

        $credentials['is_active'] = true;

        $token = auth('user')->attempt($credentials);

        if (!$token) {
            return redirect()->back()
                ->withErrors(['email' => __('common.error')])
                ->withInput();
        }

        $cookie = cookie('user_token', $token, 60 * 24,null,null,null,true,false,null);

        return redirect()->route('user.dashboard')->cookie($cookie);
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->route('user.login');
    }
}
