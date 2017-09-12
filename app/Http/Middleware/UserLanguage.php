<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Language;

class UserLanguage
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
		// set locale for all request to display data
		if(!Session::has('language'))
		{
			$language = Language::where('is_default', 1)->first();
			if (is_null($language)) {
				$language = Language::first();
			}
			Session::put('language', $language->code);
		}

		app()->setLocale(Session::get('language'));
		
		return $next($request);
	}
}
