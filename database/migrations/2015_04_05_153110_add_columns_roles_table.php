<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('roles', function(Blueprint $table) {
            $table->string('display_name');
            $table->text('description');
            $table->text('acronym');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('roles', function(Blueprint $table) {
            $table->dropColumn('display_name');
            $table->dropColumn('description');
            $table->dropColumn('acronym');
        });
	}

}
