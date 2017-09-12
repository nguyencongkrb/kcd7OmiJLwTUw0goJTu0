<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testimonial_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('testimonial_id')->unsigned();
			$table->string('locale', 5);
			$table->string('full_name', 50);
			$table->string('job_title', 50);
			$table->string('company_name', 250);
			$table->string('content', 250);
			$table->unique(['testimonial_id','locale']);
			$table->foreign('testimonial_id')->references('id')->on('testimonials')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testimonial_translations');
	}
}
