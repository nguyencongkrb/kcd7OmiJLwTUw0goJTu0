<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}

	protected function credentials(Request $request)
	{
		$credentials = $request->only($this->username(), 'password');

		// add attribute check authencation
		$credentials = array_add($credentials, 'confirmed', 1);
		$credentials = array_add($credentials, 'active', 1);
		return $credentials;
	}

	public function redirectPath()
	{
		// Logic that determines where to send the user
		if (\Auth::user()->type == 1) {	// admin group user
			return 'backend/dashboard';
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}

	public function showLoginForm()
	{
		//return view('auth.login');
		return redirect()->route('home');
	}
}
