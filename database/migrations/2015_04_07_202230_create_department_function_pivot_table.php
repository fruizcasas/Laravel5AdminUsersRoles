<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentFunctionPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_function', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('department_id')->unsigned()->index();
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
			$table->integer('function_id')->unsigned()->index();
			$table->foreign('function_id')->references('id')->on('functions')->onDelete('cascade');
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
		Schema::drop('department_function');
	}

}
