<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartDiscountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopping_cart_discounts', function (Blueprint $table) {
			$table->increments('id');
			$table->double('area_info_id');
			$table->double('min_value')->default(0);
			$table->double('max_value')->default(0);
			$table->integer('discount_percentage')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('shopping_cart_discounts');
	}
}
