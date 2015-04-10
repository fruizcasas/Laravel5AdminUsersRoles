<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryFrontpagePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_frontpage', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('category_id')->unsigned()->index();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
		Schema::drop('category_frontpage');
	}

}
