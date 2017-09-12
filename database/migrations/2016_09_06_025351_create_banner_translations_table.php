<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banner_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('banner_id')->unsigned();
			$table->string('locale', 5);
			$table->string('name', 250);
			$table->string('summary',500);
			$table->text('content');
			$table->string('link', 1000);
			$table->unique(['banner_id','locale']);
			$table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banner_translations');
	}
}
