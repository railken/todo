<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application.
|
*/

Route::get('/sign-in', ['as' => 'sign-in',	function() {	return view('Nut::sign-in'); }]);
