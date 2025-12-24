<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = 'user', $mode = 'protected')
    {

        $loginRoute = $guard === 'admin' ? 'admin.login' : 'user.login';
        $dashboard  = $guard === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $isloggedin = Auth::guard($guard)->check();

        if($mode === 'protected' && !$isloggedin){
            if($request->expectsJson()){
                return response()->json(['error' =>'authentication required'],401);
            }
            return redirect()->route($loginRoute);
        }

        if($mode === 'redirect' && $isloggedin){
            return redirect()->route($dashboard);
        }

        return $next($request);
    }
}
