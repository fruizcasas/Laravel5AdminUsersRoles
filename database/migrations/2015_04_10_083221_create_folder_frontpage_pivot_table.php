<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolderFrontpagePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('folder_frontpage', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('folder_id')->unsigned()->index();
			$table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
			$table->integer('frontpage_id')->unsigned()->index();
			$table->foreign('frontpage_id')->references('id')->on('frontpages')->onDelete('cascade');
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
		Schema::drop('folder_frontpage');
	}

}
