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
            $table->integer('author_id')->unsigned()->nullable()->index();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->integer('reviewer_id')->unsigned()->nullable()->index();
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->integer('approver_id')->unsigned()->nullable()->index();
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->integer('publisher_id')->unsigned()->nullable()->index();
            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
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
