<?php

class UserController extends \BaseController {

	public function getUser($id) {
		return User::find($id);
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




}
