<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOccasionIdColumnToOccasionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('occasion_user', function($table)
		{
		    $table->dropColumn('event_id');
		    $table->integer('occasion_id');	

		});	

}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('occasion_user', function($table)
		{
		    $table->integer('event_id');
		    $table->dropColumn('occasion_id');	

		});		}

}
