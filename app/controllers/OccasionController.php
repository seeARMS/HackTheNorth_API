<?php

class OccasionController extends \BaseController {


	public function postOccasion() {
		$input = Input::all();

		$name = $input['event_name'];
		$id	  = $input['user_id'];

		$occasion = new Occasion();
		$occasion->name = $name;
		$occasion->save();

		$occasion->users()->attach($id);

		return $occasion;
	}


}
