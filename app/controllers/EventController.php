<?php

class OccasionController extends \BaseController {


	public function postOccasion() {
		$input = Input::all();





		$occasion = new Occasion();

		$occasion->name = $input['name'];

		$occasion->save();

		return $occasion;
	}




}
