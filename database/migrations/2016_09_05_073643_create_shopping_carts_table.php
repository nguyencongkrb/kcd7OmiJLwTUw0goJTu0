<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopping_carts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code', 15)->index();
			$table->string('customer_name', 50);
			$table->string('customer_email', 50)->nullable();
			$table->string('customer_phone', 20)->index();
			$table->string('customer_address', 250);
			$table->integer('province_id');
			$table->integer('district_id');
			$table->boolean('shipping_address_same_order')->default(1);
			$table->string('shipping_name', 50)->nullable();
			$table->string('shipping_email', 50)->nullable();
			$table->string('shipping_phone', 20)->nullable();
			$table->string('shipping_address', 250)->nullable();
			$table->integer('shipping_province_id')->nullable();
			$table->integer('shipping_district_id')->nullable();
			$table->integer('delivery_method_id')->default(0);
			$table->double('shipping_fee')->default(0);
			$table->date('delivery_date');
			$table->string('customer_note', 300)->nullable();
			$table->string('delivery_note', 300)->nullable();
			$table->string('customer_service_note', 300)->nullable();
			$table->boolean('invoice_export')->default(0);
			$table->boolean('invoice_exported')->default(0);
			$table->integer('customer_id')->nullable();
			$table->integer('payment_method_id');
			$table->boolean('payment_status')->default(0);
			$table->integer('shopping_cart_status_id');
			$table->integer('created_by')->nullable()->default(null);
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->integer('deleted_by')->nullable();
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
		Schema::drop('shopping_carts');
	}
}
