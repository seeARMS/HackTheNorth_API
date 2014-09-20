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

Route::get('/user/{id}', 'UserController@getUser');
Route::get('/user/', 'UserController@getAll');
Route::post('/user/', 'UserController@registerUser');
Route::get('/user/occasion/{id}', 'UserController@getUsersOccasions');

Route::post('/occasion/', 'OccasionController@postOccasion');


Route::get('/test/', 'UserController@sendMessage');
Route::get('/algorithm/', 'UserController@testAlgorith');

//Route::controller('users', 'UserController');

