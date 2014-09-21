<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOccasionIdToTimeslotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('timeslots', function($table)
		{
			//$table->integer('occasion_id')->unsigned();

			//$table->integer('user_id')->unsigned();	
			$table->foreign('occasion_id')->references('id')->on('occasions');	

		});		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('timeslots', function($table)
		{
			$table->dropForeign('occasion_id');	

			$table->dropColumn('occasion_id');

	
		});
	}

}
