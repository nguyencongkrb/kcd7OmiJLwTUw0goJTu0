<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceInfosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_infos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('company_name', 250);
			$table->string('company_address', 250);
			$table->string('tax_code')->index();
			$table->integer('shopping_cart_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('invoice_infos');
	}
}
