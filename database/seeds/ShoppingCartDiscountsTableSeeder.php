<?php

use Illuminate\Database\Seeder;
use App\ShoppingCartDiscount;

class ShoppingCartDiscountsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		ShoppingCartDiscount::create([
			'area_info_id' => '1',
			'min_value' => 2000000,
			'max_value' => 5000000,
			'discount_percentage' => 1
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '1',
			'min_value' => 5000000,
			'max_value' => 10000000,
			'discount_percentage' => 2
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '1',
			'min_value' => 10000000,
			'max_value' => 20000000,
			'discount_percentage' => 3
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '1',
			'min_value' => 20000000,
			'max_value' => 999999999,
			'discount_percentage' => 5
		]);
		//----------------------
		ShoppingCartDiscount::create([
			'area_info_id' => '5',
			'min_value' => 5000000,
			'max_value' => 10000000,
			'discount_percentage' => 1.5
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '5',
			'min_value' => 10000000,
			'max_value' => 20000000,
			'discount_percentage' => 2
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '5',
			'min_value' => 20000000,
			'max_value' => 999999999,
			'discount_percentage' => 4
		]);
		//----------------------------
		ShoppingCartDiscount::create([
			'area_info_id' => '6',
			'min_value' => 5000000,
			'max_value' => 10000000,
			'discount_percentage' => 1
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '6',
			'min_value' => 10000000,
			'max_value' => 20000000,
			'discount_percentage' => 1.5
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '6',
			'min_value' => 20000000,
			'max_value' => 999999999,
			'discount_percentage' => 3
		]);
		//----------------------------
		ShoppingCartDiscount::create([
			'area_info_id' => '4',
			'min_value' => 10000000,
			'max_value' => 20000000,
			'discount_percentage' => 1
		]);
		ShoppingCartDiscount::create([
			'area_info_id' => '4',
			'min_value' => 20000000,
			'max_value' => 999999999,
			'discount_percentage' => 2
		]);
	}
}
