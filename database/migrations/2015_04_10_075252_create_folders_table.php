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
        DB::statement('create view sp_folders as select * from folders');
        DB::statement('create view sc_folders as select * from folders');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('drop view if exists sc_folders');
        DB::statement('drop view if exists sp_folders');
		Schema::drop('folders');
	}

}
