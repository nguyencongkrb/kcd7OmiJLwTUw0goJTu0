<?php

use Illuminate\Database\Seeder;
use App\ShoppingCartStatus;

class ShoppingCartStatusesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		ShoppingCartStatus::create([
			'name' => 'Mới đặt hàng'
		]);
		ShoppingCartStatus::create([
			'name' => 'Đã xác nhận'
		]);
		ShoppingCartStatus::create([
			'name' => 'Đang giao hàng'
		]);
		ShoppingCartStatus::create([
			'name' => 'Đã giao hàng'
		]);
	}
}
