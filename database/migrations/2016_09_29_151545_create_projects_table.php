<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
			$table->string('key', 250)->unique()->index();
			$table->integer('priority');
			$table->boolean('not_delete')->default(0);  // not delete, not change key
			$table->date('execution_time')->nullable();
			$table->string('website', 250);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->boolean('published')->default(0);
			$table->integer('published_by')->nullable();
			$table->dateTime('published_at')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}
}
