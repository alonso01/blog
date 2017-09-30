<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//add tags field to posts
		Schema::table('posts', function (Blueprint $table) {
			$table->string('tags', 2000);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function (Blueprint $table) {
			$table->dropColumn('tags');
		});
	}

}
