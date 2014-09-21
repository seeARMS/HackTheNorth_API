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
		$score = array_fill(0, 10000, 0);
		//$score[0] = 'test';
		//$score = 0;

		$k = 0;

		$previous = new Carbon($occasion->start);

		// implement eager loading
		for ($i = 0; $i < $diff; $i += 15) {
			for ($j = 0; $j < $num_users; $j++) {

				$start = new Carbon($occasion->start);

				$start->addMinutes($i);

				$timeslot = Timeslot::where('user_id', '=', $j)
									->where('start', '<=', $previous->toDateTimeString())
									->where('end', '>=', $start->toDateTimeString())->first();




				if ($timeslot != null) {
					//dd($timeslot);

					//$score = array_add($score, $i, $timeslot->weighting);

					$score[$i] += $timeslot->weighting; 

					//$score[$i] += $timeslot->weighting;
					//$score[] = array($timeslot->weighting);
					//$k++;
					//var_dump($score);



				}


		}
			$previous = $start;

		
	}

	$score = array_filter($score);
	


	//dd($score);
		rsort($score);
		$top3 = array_reverse(array_slice($score, 0, 3));

		Mail::send('emails.invite', $data, function($message)
		{
		    $message->to('jane@example.com', 'Jane Doe')->subject('This is a demo!');
		});



		$app_id = 'jVmr9Q4ItzKs2abze4T2mRvECJ8AxMwCKT5G8anC';
		$rest_key = 'hNv7GwawFKdvpyb6B6u8sLqlSQMW3YWWRQeKVll7';
		$master_key = 'wzwEOPsb5w45qWQQVJSCqTtL6yvD82Y90SiVDh4y';


		ParseClient::initialize($app_id, $rest_key, $master_key );


		$data = array("alert" => "Hi!");

		ParsePush::send(array(
		  "channels" => ["PHPFans"],
		  "data" => $data
		));

		$query = ParseInstallation::query();
		$query->equalTo("design", "rad");
		ParsePush::send(array(
		  "where" => $query,
		  "data" => $data
		));


	//	dd($score);


}
}