<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryFeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_fees', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('area_info_id');
			$table->integer('min_weight')->default(0);
			$table->integer('max_weight')->default(0);
			$table->double('fee')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('delivery_fees');
	}
}
