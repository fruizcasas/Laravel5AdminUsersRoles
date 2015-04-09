<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
            $table->string('acronym')->nullable();
            $table->string('display_name')->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
            $table->text('comments')->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
            $table->boolean('is_author')->default(false)->nullable();
            $table->boolean('is_reviewer')->default(false)->nullable();
            $table->boolean('is_approver')->default(false)->nullable();
            $table->boolean('is_publisher')->default(false)->nullable();
            $table->softDeletes();
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
