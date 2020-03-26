<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard('admin')->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'teacher':
                if (Auth::guard('teacher')->check()) {
                    return redirect()->route('teacher.dashboard');
                }
                break;
            case 'student':
                if (Auth::guard('student')->check()) {
                    return redirect()->route('student.dashboard');
                }
                break;

//            default:
//                if (Auth::guard($guard)->check()) {
//                    return redirect(RouteServiceProvider::HOME);
//                }
        }
        return $next($request);
    }
}
