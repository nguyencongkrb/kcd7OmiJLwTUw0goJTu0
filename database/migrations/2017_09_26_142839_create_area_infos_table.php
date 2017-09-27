<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaInfosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_infos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->integer('standard_delivery_days')->default(24);
			$table->integer('express_delivery_days')->default(24);
			$table->double('extend_delivery_fee')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('area_infos');
	}
}
