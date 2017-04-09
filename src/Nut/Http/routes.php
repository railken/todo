<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application.
|
*/

Route::get('/', ['as' => 'index',	function() {	return view('Nut::index'); }]);
