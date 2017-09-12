<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function (Blueprint $table) {
			$table->increments('id');			
			$table->string('path', 250)->index();
			$table->integer('priority');
			$table->boolean('published')->default(0);
			$table->integer('attachmentable_id')->index();
			$table->string('attachmentable_type', 50)->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachments');
	}
}
