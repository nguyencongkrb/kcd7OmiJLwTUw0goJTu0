<?php

use Illuminate\Database\Seeder;
use App\DeliveryFee;

class DeliveryFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryFee::create([
			'area_info_id' => '1',
			'min_weight' => 100,
			'max_weight' => 250,
			'fee' => 15000
		]);
		DeliveryFee::create([
			'area_info_id' => '1',
			'min_weight' => 250,
			'max_weight' => 500,
			'fee' => 17500
		]);
		DeliveryFee::create([
			'area_info_id' => '1',
			'min_weight' => 500,
			'max_weight' => 1000,
			'fee' => 21000
		]);
		DeliveryFee::create([
			'area_info_id' => '1',
			'min_weight' => 1000,
			'max_weight' => 1500,
			'fee' => 25500
		]);
		DeliveryFee::create([
			'area_info_id' => '1',
			'min_weight' => 1500,
			'max_weight' => 2000,
			'fee' => 29500
		]);
    }
}
