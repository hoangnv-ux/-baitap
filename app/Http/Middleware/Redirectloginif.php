<?php
namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Container\Attributes\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Request;

class Redirectloginif
{
    public function handle(Request $Request, Closure $next, $guard = 'user'){
        $cookieName = $guard === 'admin' ? 'admin_token' : 'user_token';
        $dashboard  = $guard === 'admin' ? 'admin.dashboard' : 'user.dashboard';

        $token = $Request->cookie($cookieName);

        if($token){
            try {
                if(auth($guard)->setToken($token)->check()){
                    return redirect()->route($dashboard);
                }
            } catch (\Exception $e) {
                dd($e);
            }
        }

        return $next($Request);
    }

}



?>
