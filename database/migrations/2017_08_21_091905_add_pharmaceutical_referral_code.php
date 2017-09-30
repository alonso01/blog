<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPharmaceuticalReferralCode extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pharmaceutical_companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('affiliate_code', 100);			
			$table->string('post_category', 100);			
			$table->timestamps();
		});

		Schema::table('posts', function (Blueprint $table) {
			$table->string('post_category', 100)->default('');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pharmaceutical_companies');

		Schema::table('posts', function (Blueprint $table) {
			$table->dropColumn('post_category');
		});

	}

}
