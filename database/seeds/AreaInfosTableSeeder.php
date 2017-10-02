<?php

use Illuminate\Database\Seeder;
use App\AreaInfo;

class AreaInfosTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		AreaInfo::create([
			'name' => 'Hồ Chí Minh',
			'standard_delivery_days' => 2,
			'express_delivery_days' => 1,
			'extend_delivery_fee' => 3000
		]);
		AreaInfo::create([
			'name' => 'Đà Nẵng',
			'standard_delivery_days' => 5,
			'express_delivery_days' => 3,
			'extend_delivery_fee' => 13000
		]);
		AreaInfo::create([
			'name' => 'Hà Nội',
			'standard_delivery_days' => 8,
			'express_delivery_days' => 4,
			'extend_delivery_fee' => 13000
		]);
		AreaInfo::create([
			'name' => 'Khu Vục 1',
			'standard_delivery_days' => 8,
			'express_delivery_days' => 3,
			'extend_delivery_fee' => 18000
		]);
		AreaInfo::create([
			'name' => 'Khu Vục 2',
			'standard_delivery_days' => 4,
			'express_delivery_days' => 2,
			'extend_delivery_fee' => 6000
		]);
		AreaInfo::create([
			'name' => 'Khu Vục 3',
			'standard_delivery_days' => 5,
			'express_delivery_days' => 3,
			'extend_delivery_fee' => 18000
		]);
	}
}
