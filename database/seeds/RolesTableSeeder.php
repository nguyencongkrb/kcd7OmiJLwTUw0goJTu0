<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
			'key'	=> 'Administrator',
			'name'	=> 'Administrator',
			'description'	=> 'Quản trị viên'
		]);
		Role::create([
			'key'	=> 'SuperModerator',
			'name'	=> 'Super Moderator',
			'description'	=> 'Super Moderator'
		]);
		Role::create([
			'key'	=> 'Moderator',
			'name'	=> 'Moderator',
			'description'	=> 'Moderator'
		]);
		Role::create([
			'key'	=> 'Normal',
			'name'	=> 'Người dùng web',
			'description'	=> 'Người dùng web'
		]);
		Role::create([
			'key'	=> 'Staffs',
			'name'	=> 'Nhân viên',
			'description'	=> 'Nhân viên'
		]);
		Role::create([
			'key'	=> 'Agency',
			'name'	=> 'Đại lý',
			'description'	=> 'Đại lý'
		]);
		Role::create([
			'key'	=> 'Share',
			'name'	=> 'Tài khoản dùng chung',
			'description'	=> 'Tài khoản dùng chung'
		]);
    }
}
