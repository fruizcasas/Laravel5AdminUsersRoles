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
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('order')->unsigned()->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
            $table->boolean('is_employee')->default(false)->nullable();
            $table->boolean('is_author')->default(false)->nullable();
            $table->boolean('is_reviewer')->default(false)->nullable();
            $table->boolean('is_approver')->default(false)->nullable();
            $table->boolean('is_publisher')->default(false)->nullable();
            $table->softDeletes();
            $table->timestamps();
		});
        DB::statement('create view sp_users as select * from users');
        DB::statement('create view sc_users as select * from users');

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('drop view if exists sc_users');
        DB::statement('drop view if exists sp_users');
        Schema::drop('users');
	}

}
