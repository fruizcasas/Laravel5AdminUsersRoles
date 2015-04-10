<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontpagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('frontpages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('edition')->unsigned();
            $table->string('status');
            $table->timestamp('review_date');
            $table->timestamp('publishing_date');
            $table->integer('total_pages')->nullable();
            $table->string('title');
            $table->string('reason_for_revision');
            $table->integer('author_id')->unsigned();
            $table->integer('reviewer_id')->unsigned();
            $table->integer('approver_id')->unsigned();
            $table->integer('publisher_id')->unsigned();
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
		Schema::drop('frontpages');
	}

}
