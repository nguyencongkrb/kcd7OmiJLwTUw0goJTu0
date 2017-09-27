<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionCodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotion_codes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code', 10);
			$table->boolean('value_type')->default(1);  // 0: cash, 1: percent
			$table->double('cash_value')->default(0);
			$table->integer('percent_value')->default(0);
			$table->date('effective_date');
			$table->date('expiry_date');
			$table->integer('quantity')->default(0);
			$table->integer('quantity_used')->default(0);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('promotion_codes');
	}
}
