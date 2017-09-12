<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerCategoryTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banner_category_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('banner_category_id')->unsigned();
			$table->string('locale', 5);
			$table->string('name', 250);
			$table->string('summary', 500);
			$table->string('meta_description', 500);
			$table->string('meta_keywords', 500);

			$table->unique(['banner_category_id','locale']);
			$table->foreign('banner_category_id')->references('id')->on('banner_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banner_category_translations');
	}
}
