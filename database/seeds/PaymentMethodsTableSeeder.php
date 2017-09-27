<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		PaymentMethod::create([
			'name' => 'Thanh toán khi nhận hàng'
		]);
		PaymentMethod::create([
			'name' => 'Thẻ tín dụng'
		]);
		PaymentMethod::create([
			'name' => 'Thẻ ATM nội địa'
		]);
		PaymentMethod::create([
			'name' => 'Chuyển Khoản'
		]);
		PaymentMethod::create([
			'name' => 'Thanh toán sau'
		]);
	}
}
