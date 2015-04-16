<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('acronym')->nullable();
            $table->string('display_name')->nullable();
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('create view sp_categories as select * from categories');
        DB::statement('create view sc_categories as select * from categories');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('drop view if exists sc_categories');
        DB::statement('drop view if exists sp_categories');
		Schema::drop('categories');
	}

}
