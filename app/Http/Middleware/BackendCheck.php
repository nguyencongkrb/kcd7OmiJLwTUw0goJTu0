<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class BackendCheck
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
        if (!Auth::check() || Auth::user()->type == 0 || count(Auth::user()->roles()->get()) == 0) {
            Auth::logout();
            abort(403);
        }

        return $next($request);
    }
}
