<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            Session::put('loginSession','invalid');
            return redirect() -> route('adminsignin');
        }
         if (Auth::guard($guard)->check()) {
            //Session::put('loginSession','Success');
            return redirect() -> route('customer_side.pages.signin');
        }

        return $next($request);
    }
}
