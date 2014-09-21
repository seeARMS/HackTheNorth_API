<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/user/{email}', 'UserController@getUser');
Route::get('/user/', 'UserController@getUser');
Route::post('/user/', 'UserController@registerUser');

Route::any('/user-register', 'UserController@registerMultipleUsers');

Route::get('/user/occasion/{id}', 'UserController@getUsersOccasions');

Route::post('/occasion/', 'OccasionController@postOccasion');


Route::get('/test/', 'UserController@sendMessage');
Route::get('/algorithm/', 'UserController@testAlgorithm');




//Route::controller('users', 'UserController');

