<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = 'user',$mode = 'protect')
    {
        $loginRoute = $guard === 'admin' ? 'admin.login' : 'user.login';
        $dashboard  = $guard === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $isLoggedIn = Auth::guard($guard)->check();

        if($mode === 'protect' && !$isLoggedIn){
            if($request->expectsJson()){
                return response()->json(['error'=>'Unauthenticated',401]);
            }
            return redirect()->route($loginRoute);
        }

        if($mode === 'redirect' && $isLoggedIn){
            return redirect()->route($dashboard);
        }

        return $next($request);
    }
}
