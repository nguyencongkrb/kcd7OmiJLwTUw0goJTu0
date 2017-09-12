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
    }
}
