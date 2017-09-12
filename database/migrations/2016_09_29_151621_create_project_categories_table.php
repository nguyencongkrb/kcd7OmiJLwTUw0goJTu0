<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('key', 250)->unique()->index();
			$table->integer('parent_id')->nullable();
			$table->integer('priority')->default(0);
			$table->boolean('published')->default(0);
			$table->boolean('not_delete')->default(0);  // not delete, not change key
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamps();
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
		Schema::drop('project_categories');
	}
}
