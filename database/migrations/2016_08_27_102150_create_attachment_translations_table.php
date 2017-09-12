<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachment_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('attachment_id')->unsigned();
			$table->string('locale', 5);
			$table->string('description', 500);
			$table->unique(['attachment_id','locale']);
			$table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachment_translations');
	}
}
