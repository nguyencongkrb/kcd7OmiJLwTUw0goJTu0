<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalValueTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('additional_value_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('additional_value_id')->unsigned();
			$table->string('locale', 5);
			$table->string('name', 250);
			$table->string('summary', 250);
			$table->string('content', 500);

			$table->unique(['additional_value_id','locale']);
			$table->foreign('additional_value_id')->references('id')->on('additional_values')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('additional_value_translations');
	}
}
