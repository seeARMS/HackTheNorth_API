<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccasionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('occasion_user', function($table)
		{
		    $table->increments('id')->unsigned();
		    $table->integer('event_id');	
		    $table->integer('user_id');	
   		    $table->boolean('complete')->default(0);	
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('occasion_user');
	}

}
