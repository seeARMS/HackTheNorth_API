<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeslotFkToUserAndOccasionTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		
		// Schema::table('users', function($table)
		// {
		// 	//$table->integer('timeslot_id')->unsigned();

		// 	$table->dropForeign('users_timeslot_id_foreign');
		// 	$table->dropColumn('timeslot_id');	
		// });	


		Schema::table('timeslots', function($table)
		{
			//$table->integer('timeslot_id')->unsigned();

			//$table->integer('user_id')->unsigned();	
			$table->foreign('user_id')->references('id')->on('users');	

		});	


	}

		/*
		Schema::table('users', function($table)
		{
			//$table->integer('timeslot_id')->unsigned();

			$table->foreign('timeslot_id')->references('id')->on('timeslots');	
		});	

		Schema::table('occasions', function($table)
		{
			//$table->integer('timeslot_id')->unsigned();

			$table->foreign('timeslot_id')->references('id')->on('timeslots');	
		});	
		
	/*



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::table('occasions', function($table)
		// {
		// 	$table->dropForeign('timeslot_id');	

		// 	$table->dropColumn('timeslot_id');

	
		// });


		// Schema::table('users', function($table)
		// {
		// 	$table->dropForeign('timeslot_id');	

		// 	$table->dropColumn('timeslot_id');

	
		// });




	}

}
