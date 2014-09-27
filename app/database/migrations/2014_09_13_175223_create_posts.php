<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('posts', function($table)
		{
		$table->increments('id');
		$table->string('title');
		$table->string('blogpost');
		$table->boolean('complete');
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
		//
		Schema::drop('posts');
	}

}
