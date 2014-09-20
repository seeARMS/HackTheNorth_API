<?php

class EventController extends \BaseController {


	public function postEvent() {
		$input = Input::all();

		$event = new Event();

		$event->name = $input['name'];

		$event->save();

		return $event;
	}




}
