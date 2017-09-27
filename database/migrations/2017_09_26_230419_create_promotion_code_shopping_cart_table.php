<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionCodeShoppingCartTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prommotion_code_shopping_cart', function (Blueprint $table) {
			$table->integer('promotion_code_id')->nullable()->unsigned()->index();
			$table->foreign('promotion_code_id')->references('id')->on('promotion_codes')->onDelete('cascade');
			$table->integer('shopping_cart_id')->nullable()->unsigned()->index();
			$table->foreign('shopping_cart_id')->references('id')->on('shopping_carts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('prommotion_code_shopping_cart');
	}
}
