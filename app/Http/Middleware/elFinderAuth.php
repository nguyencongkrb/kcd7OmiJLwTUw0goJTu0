<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class elFinderAuth
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
        if($request->path() != 'elfinder/connector' && (!Auth::check() || Auth::user()->type == 0)){    // normal user
            abort(404);
        }

        return $next($request);
    }
}
