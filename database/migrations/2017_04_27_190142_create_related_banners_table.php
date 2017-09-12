<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedBannersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('related_banners', function (Blueprint $table) {
			$table->integer('banner_id')->nullable()->unsigned()->index();
			$table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
			$table->integer('related_banner_id')->nullable()->unsigned()->index();
			$table->foreign('related_banner_id')->references('id')->on('banners')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('related_banners');
	}
}
