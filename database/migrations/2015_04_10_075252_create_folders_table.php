<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('folders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('folder_id')->nullable()->unsigned()->index();
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('set null');
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->text('description')->nullable();
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
		Schema::drop('folders');
	}

}
