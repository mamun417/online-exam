<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check active status
        if (Auth::user()->status == 0){
            Auth::logout();
            return redirect('login')->with('error', 'Your account is not active. Please contact with admin.');
        }

        return $next($request);
    }
}
