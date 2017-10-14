<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->dateTime('birthday')->nullable();
			$table->boolean('gender')->nullable();
			$table->string('job_title', 50);
			$table->string('mobile_phone', 20);
			$table->string('home_phone', 20);
			$table->string('address', 250);
			$table->integer('province_id')->nullable();
			$table->integer('district_id')->nullable();
			$table->string('website', 250);
			$table->string('facebook', 250);
			$table->string('username')->unique();
			//$table->string('email')->unique();
			$table->string('email')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->boolean('type')->default(0);	// 0 nornal user, 1 admin group user
			$table->boolean('active')->default(0);
			$table->boolean('confirmed')->default(0);
			$table->string('confirmation_code')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
}
