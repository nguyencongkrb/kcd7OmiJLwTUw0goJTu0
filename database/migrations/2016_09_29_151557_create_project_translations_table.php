<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->string('locale', 5);
			$table->string('name', 250);
			$table->string('client_name', 250);
			$table->string('summary', 500);
			$table->text('description');
			$table->string('meta_description', 500);
			$table->string('meta_keywords', 500);

			$table->unique(['project_id','locale']);
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_translations');
	}
}
