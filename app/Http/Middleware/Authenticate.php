<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = 'user', $mode = 'protect')
    {
        $loginRoute = $guard === 'admin' ? 'admin.login' : 'user.login';
        $dashboardRoute = $guard = 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $isloginIn = Auth::guard($guard)->check();

        if($mode === 'protect' && !$isloginIn){
            return redirect()->route($loginRoute);
        }

        if($mode === 'redirect' && $isloginIn){
            return redirect()->route($dashboardRoute);
        }

        return $next($request);
    }
}
