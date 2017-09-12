<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Hash;
use App\Config;

class ProtectWebsiteUnderConstruction
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
		$password = Config::findByKey('password_protect_website')->first();

		if ($password && !empty($password->value)) {

			$password = $password->value;

			if ($request->route()->getName() == 'under.construction') {
				return $next($request);
			}

			if ($request->route()->getName() == 'under.construction.authentication') {
				$userPassword = $request->input('password', '');
				if($password == $userPassword) {
					Session::put('password_protect_website', Hash::make($userPassword));
					return redirect()->route('home');
				}
				else{
					return redirect()->route('under.construction')->with('status', 'Invalid password please try again.');
				}
			}

			$userPassword = Session::get('password_protect_website');
			if(!Hash::check($password, $userPassword)) {
				return redirect()->route('under.construction');
			}
		}



		/*
		if (!empty($password)
			&& $request->route()->getName() != 'under.construction'
			&& $request->route()->getName() != 'under.construction.authentication') {

			$userPassword = Session::has('password_protect_website') ? Session::get('password_protect_website') : $request->input('password', '');

			return dd($userPassword);

			if(!Hash::check($password, Session::get('password_protect_website'))){
				return redirect()->route('under.construction');
			}
		}
		*/

		return $next($request);
	}
}
