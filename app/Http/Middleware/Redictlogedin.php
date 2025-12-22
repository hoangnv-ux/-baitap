<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Redictlogedin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'user')
    {
        $cookieName = $guard === 'admin' ? 'admin_token' : 'user_token';
        $routeName  = $guard === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $token = $request->cookie($cookieName);

        if($token){
            try {
                if(auth($guard)->setToken($token)->check()){
                    return redirect()->route($routeName);
                }
            } catch (\Exception $e) {
                return $e;
            }
        }

        return $next($request);
    }
}
