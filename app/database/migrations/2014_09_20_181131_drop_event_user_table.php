<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEventUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('event_user');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('event_user', function($table)
		{
		    $table->increments('id')->unsigned();
		    $table->integer('event_id');	
		    $table->integer('user_id');	
   		    $table->boolean('complete')->default(0);	
		});	}

}
