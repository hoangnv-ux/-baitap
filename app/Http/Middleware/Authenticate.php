<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = 'user')
    {

        $loginRoute = $guard === 'admin' ? 'admin.login' : 'user.login';
        $dashboard  = $guard === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $islogedin = Auth::guard($guard)->check();

        $currentRoute = optional($request->route()->getName());

        if(!$islogedin && $currentRoute !== $loginRoute ){

            return redirect()->route($loginRoute);
        }

        if($islogedin && $currentRoute === $loginRoute){
            return redirect()->route($dashboard);
        }



        return $next($request);
    }
}
