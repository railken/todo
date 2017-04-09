<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application.
|
*/

Route::post('/oauth/{name}/authorize', ['uses' => 'Auth\SignInController@auth']);
Route::any('/oauth/{name}/token', ['uses' => 'Auth\SignInController@token']);



Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/user/profile', ['uses' => 'User\ProfileController@index']);


	Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
		Route::group(['prefix' => 'users'], function() {
			Route::get('/', ['uses' => 'UsersController@index'] );
			Route::post('/', ['uses' => 'UsersController@create'] );
			Route::get('/{id}', ['uses' => 'UsersController@show'] );
			Route::put('/{id}', ['uses' => 'UsersController@update'] );
			Route::delete('/{ids}', ['uses' => 'UsersController@delete'] );
		} );
	} );

});
