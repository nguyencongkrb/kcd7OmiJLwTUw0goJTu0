<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleArticleTypeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_article_type', function (Blueprint $table) {
			$table->integer('article_id')->nullable()->unsigned()->index();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
			$table->integer('article_type_id')->nullable()->unsigned()->index();
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
		Schema::drop('article_article_type');
	}
}
