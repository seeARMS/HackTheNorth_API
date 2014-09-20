<?php
use Parse\ParseClient;
use Parse\ParsePush;
use Parse\ParseInstallation;

use src\Scheduling\Algorithm;

class UserController extends \BaseController {

	public function getUser($id) {
		return User::find($id);
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


	public function sendMessage() {
		//Twilio::message('+15195805110', 'This is a test!');

		// $data = array('hey!');

		// Mail::send('emails.invite', $data, function($message)
		// {
		//     $message->to('colinarms@gmail.com', 'Jane Doe')->subject('This is a demo!');
		// });


		$app_id = 'jVmr9Q4ItzKs2abze4T2mRvECJ8AxMwCKT5G8anC';
		$rest_key = 'hNv7GwawFKdvpyb6B6u8sLqlSQMW3YWWRQeKVll7';
		$master_key = 'wzwEOPsb5w45qWQQVJSCqTtL6yvD82Y90SiVDh4y';


		ParseClient::initialize( $app_id, $rest_key, $master_key );


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



	}


	public function testAlgorithm() {
		
		$alg = new Algorithm();


		return $alg->storeSchedule();


	}



}
