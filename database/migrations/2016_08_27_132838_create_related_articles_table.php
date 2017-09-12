<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedArticlesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('related_articles', function (Blueprint $table) {
			$table->integer('article_id')->nullable()->unsigned()->index();
			$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
			$table->integer('related_article_id')->nullable()->unsigned()->index();
			$table->foreign('related_article_id')->references('id')->on('articles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('related_articles');
	}
}
