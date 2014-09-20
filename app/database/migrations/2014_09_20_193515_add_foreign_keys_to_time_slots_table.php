<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTimeSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::table('timeslots', function($table)
		// {
		// 	$table->integer('user_id')->unsigned();
		// 	$table->integer('occasion_id')->unsigned();

		// 	$table->foreign('user_id')->references('id')->on('users');	
		// 	$table->foreign('occasion_id')->references('id')->on('occasions');	
		// });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::table('timeslots', function($table)
		// {
		// 	$table->dropForeign('timeslots_occasion_id_foreign');	
		// 	$table->dropForeign('timeslots_user_id_foreign');

		// 	$table->dropColumn('user_id')->unsigned();
		// 	$table->dropColumn('occasion_id')->unsigned();

	
		// });
	}

}
