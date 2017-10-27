<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->string('key', 250)->unique()->index();
			$table->string('code', 20)->unique()->index();
			$table->string('model', 100);
			$table->string('custom_size', 100);
			$table->integer('weight')->default(0);
			$table->integer('producer_id')->nullable();
			$table->string('origin', 100);
			$table->string('unit', 100);
			$table->integer('inventory_quantity')->default(0);
			$table->dateTime('instock_date')->nullable();
			$table->double('price')->default(0);
			$table->double('sale_price')->default(0);
			$table->integer('sale_ratio')->default(0);
			$table->dateTime('sale_starts')->nullable();
			$table->dateTime('sale_ends')->nullable();
			$table->enum('availability', ['instock', 'outofstock', 'preorder', 'availablefororder']);
			$table->string('warranty', 100);
			$table->integer('priority')->default(0);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->boolean('published')->default(0);
			$table->integer('published_by')->nullable();
			$table->dateTime('published_at')->nullable();
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
		Schema::drop('products');
	}
}
