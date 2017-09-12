<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Language::create([
			'code' => 'vi',
			'name' => 'Tiếng Việt',
			'priority' => 0,
			'is_default' => 1,
			'is_key_language' => 1
		]);
		/*
		Language::create([
			'code' => 'en',
			'name' => 'English',
			'priority' => 1,
			'is_default' => 0,
			'is_key_language' => 0
		]);
		*/
	}
}
