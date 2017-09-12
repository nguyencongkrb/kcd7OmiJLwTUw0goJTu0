<?php

use Illuminate\Database\Seeder;
use App\AdditionalCategory;

class AdditionalCategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		AdditionalCategory::create([
			'name' => 'HiddenControls'
		]);
	}
}
