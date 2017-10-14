<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// user type: 1: admin, 0: normal user
		$user = User::create([
			'last_name'		=> 'Phan',
			'first_name'	=> 'Sang',
			'job_title'		=> 'Quản lý',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'username'		=> 'admin@gmail.com',
			'email'			=> 'admin@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 1,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		$user->roles()->attach([1]);

		User::create([
			'last_name'		=> 'User',
			'first_name'	=> 'Normal',
			'job_title'		=> 'Normal',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'username'		=> 'normal@gmail.com',
			'email'			=> 'normal@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 0,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);

		User::create([
			'last_name'		=> 'Staffs',
			'first_name'	=> 'Staffs',
			'job_title'		=> 'Staffs',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'username'		=> 'staffs@gmail.com',
			'email'			=> 'staffs@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 0,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		User::create([
			'last_name'		=> 'Agency',
			'first_name'	=> 'Agency',
			'job_title'		=> 'Agency',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'username'		=> 'agency@gmail.com',
			'email'			=> 'agency@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 0,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
		User::create([
			'last_name'		=> 'Share',
			'first_name'	=> 'Share',
			'job_title'		=> 'Share',
			'mobile_phone'	=> '0909 24-7179',
			'home_phone'	=> '',
			'address'		=> '118/42 Huỳnh Thiện Lộc, Tân Phú, HCM',
			'website'		=> 'http://ketnoimoi.com',
			'facebook'		=> 'http://facebook.com/phantsang',
			'username'			=> 'share@gmail.com',
			'email'			=> 'share@gmail.com',
			'password'		=> Hash::make('123456'),
			'type'			=> 0,
			'active'		=> 1,
			'confirmed'		=> 1,
			'confirmation_code' => str_random(30)
		]);
	}
}
