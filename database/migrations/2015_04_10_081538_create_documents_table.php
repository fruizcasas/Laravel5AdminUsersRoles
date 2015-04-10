<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->string('mime')->nullable();
            $table->string('storage_path');
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
		Schema::drop('documents');
	}

}
