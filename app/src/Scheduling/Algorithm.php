<?php namespace src\Scheduling;

use Carbon\Carbon;
use \User;
use \Timeslot;
use \Occasion;

class Algorithm {

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
					  'user_id' => $user_id,
					  'occasion_id' => $occasion_id
					  );

		}

		//dd($insert);

		Timeslot::insert($insert);


		$occasion->pivot->complete = 1;
		$occasion->pivot->save();

		$num_incomplete_occasions = Occasion::find($occasion_id)->users()
																->wherePivot('complete', 0)
																->count();



		if ($num_incomplete_occasions != 0)
			return $occasion;


		// The events are done - push 
		$occasion = Occasion::find($occasion_id);

		$host_start = new Carbon($occasion->start);
		$host_end   = new Carbon($occasion->end);

		$diff = $host_start->diffInMinutes($host_end);

		$num_users = $occasion->users->count();
		

	
		$score = array();

		// implement eager loading
		for ($i = 0; $i < $diff; $i += 15) {
			for ($j = 0; $j < $num_users; $j++) {
				$timeslot = Timeslot::where('user_id', '=', $j)
									->where('start', '<', $occasion->start + $i)
									->where('end', '>', $occasion->end - $i)->first();
				
				if ($timeslot != null)
					$score[] += $timeslot->weighting;

			
			}

		}

		rsort($score);
		$top3 = array_reverse(array_slice($score, 0, 3));


		dd($top3);


		
	}



}
