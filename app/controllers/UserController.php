<?php
use Parse\ParseClient;
use Parse\ParsePush;
use Parse\ParseInstallation;

use src\Scheduling\Algorithm;

class UserController extends \BaseController {

	public function getUser($email) {
		return User::where('email', '=', $email)->get();
	}

	public function getUsersOccasions($id) {
		return User::find($id)->occasions;
	}

	public function getAll() {
		return User::all();
	}

	public function registerUser() {
		$input = Input::all();

		$user = new User();

		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->phone = $input['phone'];

		$user->save();

		return $user;
	}


	// its gonne be here
	public function registerMultipleUsers() {
		$input = Input::all();

		//dd(Input::all());


		//$input = json_decode(Input::get('data'));
		//$input = json_decode($json);

		\Log::error($input);


		$event_num = $input->event;
		$names = $input->names;

		//dd($event_num);

		for ($i = 0; $i < count($names); $i++) {
			$user = User::where('name', '=', $names[$i])->first();

			$user->occasions()->attach($event_num);
			$user->save();



		$app_id = 'jVmr9Q4ItzKs2abze4T2mRvECJ8AxMwCKT5G8anC';
		$rest_key = 'hNv7GwawFKdvpyb6B6u8sLqlSQMW3YWWRQeKVll7';
		$master_key = 'wzwEOPsb5w45qWQQVJSCqTtL6yvD82Y90SiVDh4y';


		ParseClient::initialize( $app_id, $rest_key, $master_key );


		$data = array("alert" => "You have been invited to an event! Press here to learn more.");

		$query = ParseInstallation::query();

		$query->equalTo("device_id", $user->id);
		ParsePush::send(array(
		  "where" => $query,
		  "data" => $data
		));


		Twilio::message($user->phone, 'You have been invited to an event! Open up Calendr to learn more.');


		$data = array('temp');

		$users = $users->each(function($user) use ($data) {
			Mail::send('emails.invite', $data, function($message) use ($user)
			{
			    $message->to($user->email, 'Jane Doe')->subject('You have been invited to an event!');
			});
		});


		}





	//	for ($i = 0)
/*


		$user = new User();

		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->phone = $input['phone'];

		$user->save();

		return $user;
		*/
	}



	public function sendMessage() {
		//Twilio::message('+15195805110', 'This is a test!');

		// $data = array('hey!');

		// Mail::send('emails.invite', $data, function($message)
		// {
		//     $message->to('colinarms@gmail.com', 'Jane Doe')->subject('This is a demo!');
		// });

/*
		$data = array();

			Mail::send('emails.invite', $data, function($message) 
			{
			    $message->to("colinarms@gmail.com", 'Jane Doe')->subject('EVent has been completed!');
			});
*/


		$users = Occasion::find(1)->users()->get();

		$data = array('temp');

		$users = $users->each(function($user) use ($data) {
			Mail::send('emails.invite', $data, function($message) use ($user)
			{
			    $message->to("colinarms@gmail.com", 'Jane Doe')->subject('EVent has been completed!');
			});
		});

		/*
		for ($i = 0; i < $users->count(); $i++) {
			
			Mail::send('emails.invite', $data, function($message) use ($users->get())
			{
			    $message->to('jane@example.com', 'Jane Doe')->subject('EVent has been completed!');
			});

		}
		*/



		/*

		$app_id = 'jVmr9Q4ItzKs2abze4T2mRvECJ8AxMwCKT5G8anC';
		$rest_key = 'hNv7GwawFKdvpyb6B6u8sLqlSQMW3YWWRQeKVll7';
		$master_key = 'wzwEOPsb5w45qWQQVJSCqTtL6yvD82Y90SiVDh4y';


		ParseClient::initialize( $app_id, $rest_key, $master_key );


		$data = array("alert" => "Hejhrfbehed!");

		$query = ParseInstallation::query();

		$query->equalTo("device_id", "1");
		ParsePush::send(array(
		  "where" => $query,
		  "data" => $data
		));
	*/


	}


	public function testAlgorithm() {
		
		$alg = new Algorithm();


		return $alg->storeSchedule();


	}



}
