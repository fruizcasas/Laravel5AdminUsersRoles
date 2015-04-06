<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
            $table->string('display_name');
            $table->text('comments');
            $table->boolean('is_owner');
            $table->boolean('is_reviewer');
            $table->boolean('is_approver');
            $table->boolean('is_signer');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('display_name');
            $table->dropColumn('comments');
            $table->dropColumn('is_owner');
            $table->dropColumn('is_reviewer');
            $table->dropColumn('is_approver');
            $table->dropColumn('is_signer');
        });
	}

}
