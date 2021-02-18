<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use function redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'doctor':
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::DOCTOR);
                }
                break;
            case 'patient' :
                if(Auth::guard($guard)->check()){
                    return redirect(RouteServiceProvider::PATIENT);
                    break;
                }
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
                break;
        }

        return $next($request);
    }
}
