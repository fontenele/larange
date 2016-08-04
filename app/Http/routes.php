<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('view/{module}/{template?}', 'EngineController@view');
Route::get('js/{module}/{file?}', 'EngineController@js');

Route::post('home', 'HomeController@home');
Route::post('view1', 'HomeController@view1');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// https://medium.com/@mshanak/laravel-5-token-based-authentication-ae258c12cfea#.yrxi49m8f

Route::post('oauth/access_token', function() {
    app('request')->json()->set('client_id', 'GXvOWazQ3lA6YSaFji');
    app('request')->json()->set('client_secret', 'abcd');
    app('request')->json()->set('grant_type', 'password');
    app('request')->json()->set('username', app('request')->json()->get('email'));
    return Response::json(Authorizer::issueAccessToken());
});

Route::post('api', ['before' => 'oauth', function() {
    // return the protected resource
    $user_id = Authorizer::getResourceOwnerId(); // the token user_id
    $user = \App\User::find($user_id);// get the user data from database
    return Response::json($user);
}]);

//Route::group(['prefix' => 'api'], function() {
//    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
//    Route::post('authenticate', 'AuthenticateController@authenticate');
//    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
//});
