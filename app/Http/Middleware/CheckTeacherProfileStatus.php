<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTeacherProfileStatus
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
        if (Auth::guard('teacher')->check() && Auth::guard('teacher')->user()->proflie_status) {
            return $next($request);
        }
        return redirect()->route('teacher.dashboard');

    }
}
