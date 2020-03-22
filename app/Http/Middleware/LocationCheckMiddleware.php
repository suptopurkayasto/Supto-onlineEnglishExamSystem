<?php

namespace App\Http\Middleware;

use App\Location;
use Closure;

class LocationCheckMiddleware
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
        if (Location::all()->count() > 0) {
            return $next($request);
        } else {
            alert('Sorry!','First you need add location', 'Info');
            return redirect()->route('admin.locations.create');
        }
    }
}
