<?php namespace src\Scheduling;

use Carbon\Carbon;
use \User;
use \Timeslot;
use \Occasion;

class Algorithm {

	public function Algorithm() {



	}

	public function calculateSchedule() {



	}


	public function storeSchedule() {
		$input['json'] = '{
						    "user": "3",
						    "event": "1",
						    "time_slots": [
						        {
						            "start": 1411239474,
						            "end": 1411539474,
						            "weighting": "5"
						        },
						        {
						            "start": 1411269474,
						            "end": 1411549474,
						            "weighting": "5"
						        }
						    ]
						}';

		$decoded = json_decode($input['json']);
		$user_id = $decoded->user;
		$occasion_id = $decoded->event;


		// Get the occasion tied to the user
		$occasion = User::find($user_id)->occasions
								 ->find($occasion_id);


		if ($occasion == null)
			return null;

		$time_slots = $decoded->time_slots;

		$insert = array();

		for ($i = 0; $i < count($time_slots); $i++) {
			$start = $time_slots[$i]->start;
			$ts_start = Carbon::createFromTimeStamp($start);

			$end = $time_slots[$i]->end;
			$ts_end = Carbon::createFromTimeStamp($end);

			$insert[] = array(
					  'start' 	=> $ts_start->toDateTimeString(),
					  'end'   	=> $ts_end->toDateTimeString(),
					  'weighting'=> $time_slots[$i]->weighting,
					  'user_id' => $user_id
					  );

		}

		//dd($insert);

		Timeslot::insert($insert);


		$occasion->pivot->complete = 1;
		$occasion->pivot->save();


		$current_occasion = Occasion::find($occasion_id)->users()->get()->pivot;



		dd($current_occasion);


		dd($decoded->time_slots);
		

		var_dump($user);




		//return $decoded[0][0];
	}



}
