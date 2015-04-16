<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->index()->after('comments');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        DB::statement('create view sp_users as select * from users');
        DB::statement('create view sc_users as select * from users');

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('drop view if exists sc_users');
        DB::statement('drop view if exists sp_users');
		Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
	}

}
