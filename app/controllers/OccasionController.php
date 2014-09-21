<?php

use Carbon\Carbon;

class OccasionController extends \BaseController {


	public function postOccasion() {
		$input = Input::all();

		$name = $input['name'];
		//$id	  = $input['user_id'];

		$start= $input['start_time'];
		$end  = $input['end_time'];

		$ts_start = Carbon::createFromTimeStamp($start);
		$ts_end = Carbon::createFromTimeStamp($end);


		$occasion = new Occasion();
		$occasion->name = $name;
		$occasion->start = $ts_start->toDateTimeString();
		$occasion->end = $ts_end->toDateTimeString();

		$occasion->save();

		//$occasion->users()->attach($id);

		return $occasion;
	}


}
