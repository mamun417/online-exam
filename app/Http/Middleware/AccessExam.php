<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AccessExam
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->package_id == 1) { // 1 = basic
            return redirect()->back()
                ->with('warning', 'Update your pricing package to participate in exam, Please contact with admin.');
        }

        return $next($request);
    }
}
