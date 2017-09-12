<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTypeTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_type_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('article_type_id')->unsigned();
			$table->string('locale', 5);
			$table->string('name', 250);
			$table->string('summary', 500);
			$table->string('meta_description', 500);
			$table->string('meta_keywords', 500);

			$table->unique(['article_type_id','locale']);
			$table->foreign('article_type_id')->references('id')->on('article_types')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('article_type_translations');
	}
}
