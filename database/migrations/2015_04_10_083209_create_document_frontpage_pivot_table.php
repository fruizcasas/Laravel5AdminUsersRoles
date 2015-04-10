<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentFrontpagePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_frontpage', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('document_id')->unsigned()->index();
			$table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
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
		Schema::drop('document_frontpage');
	}

}
