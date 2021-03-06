<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use DB;
use Notification;
use DateTime;
use Excel;
use App\Notifications\VerifyUser;
use App\Common;
use App\Language;
use App\Attachment;
use App\User;
use App\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', User::class);
		$roles = Role::all();
		return view('backend.users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRequest $request)
	{
		$this->authorize('create', User::class);

		$user = new User;
		DB::transaction(function () use ($user, $request) {
			$user->last_name = $request->input('User.last_name', '');
			$user->first_name = $request->input('User.first_name', '');
			$user->birthday = $request->input('User.birthday', '');
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = $request->input('User.gender', '');
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = $request->input('User.job_title', '');
			$user->mobile_phone = $request->input('User.mobile_phone', '');
			$user->home_phone = $request->input('User.home_phone', '');
			$user->address = $request->input('User.address', '');
			$user->website = $request->input('User.website', '');
			$user->facebook = $request->input('User.facebook', '');
			$user->email = $request->input('User.email', '');
			$user->username = $user->email;
			$user->password = Hash::make(str_random(23));
			$user->confirmation_code = str_random(30);
			$user->type = 1;	// admin group user
			$user->save();

			$user->roles()->attach($request->input('User.roles'));
		});

		Notification::send($user, new VerifyUser($user));

		if($request->ajax()){
			return response()->json(['message' => 'Thao tác thành công.']);
		}

		return redirect()->back()->with('status', 'Tài khoản đã tạo thành công. Một email kích hoạt đã được gửi đến email của người dùng mới!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		$this->authorize('update', $user);
		
		$roles = Role::all();
		return view('backend.users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserRequest $request, $id)
	{
		$user = User::findOrFail($id);
		$this->authorize('update', $user);

		DB::transaction(function () use ($user, $request) {
			$user->last_name = $request->input('User.last_name', '');
			$user->first_name = $request->input('User.first_name', '');
			$user->birthday = $request->input('User.birthday', '');
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = $request->input('User.gender', '');
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = $request->input('User.job_title', '');
			$user->mobile_phone = $request->input('User.mobile_phone', '');
			$user->home_phone = $request->input('User.home_phone', '');
			$user->address = $request->input('User.address', '');
			$user->website = $request->input('User.website', '');
			$user->facebook = $request->input('User.facebook', '');
			$user->email = $request->input('User.email', '');
			$user->username = $user->email;
			$user->save();

			if($user->id != Auth::user()->id){
				$user->roles()->detach();
				$user->roles()->attach($request->input('User.roles'));
			}
		});

		if($request->ajax()){
			return response()->json(['message' => 'Thao tác thành công.']);
		}

		return redirect()->back()->with('status', 'Tài khoản đã cập nhật thành công.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		
	}

	public function toggleActive(UserRequest $request)
	{
		$user = User::findOrFail($request->input('id'));
		$this->authorize('toggleActive', $user);

		$user->active = $user->active ? 0 : 1;
		$user->save();

		if($request->ajax()){
			return response()->json(['message' => 'Thao tác thành công.']);
		}
	}

	public function filter(UserRequest $request)
	{
		if ($request->ajax()) {
			$users = User::with('attachments', 'roles')->get();
			return response()->json($users->toArray());
		}
	}

	public function login()
	{
		if (Auth::check()) {
			return redirect()->route('dashboard.index');
		}
		return view('backend.users.login');
	}

	public function profile()
	{
		$user = Auth::user();
		$this->authorize('profile', $user);

		return view('backend.users.profile', compact('user'));
	}

	public function passwordChange(UserRequest $request)
	{		
		$user = Auth::user();
		$this->authorize('passwordChange', $user);
		$user->password = Hash::make($request->input('User.password', ''));
		$user->save();
	}

	public function resetPassword()
	{
		if (Auth::check()) {
			return redirect()->route('dashboard.index');
		}
		return view('backend.users.email');
	}

	public function showResetForm(Request $request, $token = null)
	{
		if (Auth::check()) {
			return redirect()->route('dashboard.index');
		}
		return view('backend.users.reset')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

	public function imports()
	{
		//$this->authorize('imports', User::class);
		return view('backend.users.imports');
	}

	public function importUsers(UserRequest $request)
	{
		//return dd($request->file('User.import_file'));
		$message = '';
		$errorcodes = '';

		if($request->hasFile('User.import_file')){
			ini_set('max_execution_time', 300);

			//$path = storage_path('app/public/user_list.xlsx');
			$path = $request->file('User.import_file')->path();
			Excel::filter('chunk')->load($path)->chunk(250, function($results)
			{
				foreach($results as $row)
				{
					//return dd($row);
					try {
						$user = new User;
						$user->first_name = $row['ho_ten'];
						$user->username = $row['username'];
						$user->email = $row['email'];
						$user->password = Hash::make(rand(100000, 999999));

						$user->last_name = '';
						$user->job_title = '';
						$user->address = '';
						$user->mobile_phone = '';
						$user->home_phone = '';
						$user->website = '';
						$user->facebook = '';
						$user->type = 0;
						$user->active = 1;
						$user->confirmed = 1;
						$user->save();

						if((bool)$row['loai_tai_khoan']){
							$user->roles()->attach([6]);	// đại lý
						}
						else{
							$user->roles()->attach([5]);	// nhân viên
						}
					} catch (Exception $e) {
						$errorcodes = $errorcodes . ', ' . $row['username'];
					}
				}
			});
			$message = 'Import thành công!';
		}
		else{
			$message = 'Vui lòng upload file!';
		}
		if($errorcodes != '')
			$message =  'Những user sau đã gặp lỗi trong quá trình import: ' . $errorcodes;
		return redirect(route('users.importsform'))->with('status', $message);
	}

	public function sendVerifyEmail(UserRequest $request)
	{
		$user = User::findOrFail($request->input('id'));
		$this->authorize('sendVerifyEmail', $user);
		$message = '';

		if (!empty($user->email)) {
			$newPassword = rand(100000, 999999);
			$user->password = Hash::make($newPassword);
			$user->save();
			Notification::send($user, new VerifyUser($user, $newPassword));
			$message = 'Thao tác thành công.';
		}
		else{
			$message = 'Thao tác không hợp lệ.';	
		}

		if($request->ajax()){
			return response()->json(['message' => $message]);
		}
	}
}
