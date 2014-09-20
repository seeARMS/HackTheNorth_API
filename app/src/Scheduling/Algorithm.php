<?php namespace src\Scheduling;

use Carbon\Carbon;
use \User;


class Algorithm {

	public function Algorithm() {



	}

	public function calculateSchedule() {



	}


	public function storeSchedule() {
		$input['json'] = '{
						    "user": "1",
						    "event_user": "3",
						    "time_slots": [
						        {
						            "start": 19293123,
						            "end": 2000000,
						            "weighting": "5"
						        }
						    ]
						}';

		$decoded = json_decode($input['json']);

		$user = User::find($decoded->user)


		var_dump($decoded);




		//return $decoded[0][0];
	}



}
