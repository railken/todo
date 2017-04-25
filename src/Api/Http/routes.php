<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application.
|
*/

Route::any('/oauth/{name}/authorize', ['uses' => 'Auth\SignInController@auth']);
Route::any('/oauth/{name}/token', ['uses' => 'Auth\SignInController@token']);
Route::any('/oauth/authenticated', ['as' => 'oauth.authenticated', function () {
    echo 'Redirecting...';
    die();
}]);



Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', ['uses' => 'User\ProfileController@index']);

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::group(['prefix' => 'projects'], function () {
            Route::get('/', ['uses' => 'ProjectsController@index']);
            Route::post('/', ['uses' => 'ProjectsController@create']);
            Route::get('/{id}', ['uses' => 'ProjectsController@show']);
            Route::put('/{id}', ['uses' => 'ProjectsController@update']);
            Route::delete('/{ids}', ['uses' => 'ProjectsController@delete']);
        });

        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/', ['uses' => 'TasksController@index']);
            Route::post('/', ['uses' => 'TasksController@create']);
            Route::get('/{id}', ['uses' => 'TasksController@show']);
            Route::put('/{id}', ['uses' => 'TasksController@update']);
            Route::delete('/{ids}', ['uses' => 'TasksController@delete']);
        });
    });




    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', ['uses' => 'UsersController@index']);
            Route::post('/', ['uses' => 'UsersController@create']);
            Route::get('/{id}', ['uses' => 'UsersController@show']);
            Route::put('/{id}', ['uses' => 'UsersController@update']);
            Route::delete('/{ids}', ['uses' => 'UsersController@delete']);
        });
    });
});
