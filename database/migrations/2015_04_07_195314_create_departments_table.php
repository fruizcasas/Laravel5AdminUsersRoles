<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('acronym')->nullable();
            $table->string('display_name')->nullable();
            $table->integer('department_id')->unsigned()->nullable()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null')->onUpdate('cascade');
            $table->integer('order')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('create view sp_departments as select * from departments');
        DB::statement('create view sc_departments as select * from departments');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('drop view if exists sc_departments');
        DB::statement('drop view if exists sp_departments');
		Schema::drop('departments');
	}

}
