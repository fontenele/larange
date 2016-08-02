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

Route::get('home', 'HomeController@home');
Route::get('view1', 'HomeController@view1');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// https://medium.com/@mshanak/laravel-5-token-based-authentication-ae258c12cfea#.yrxi49m8f

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('api', ['before' => 'oauth', function() {
    // return the protected resource
    //echo “success authentication”;
    $user_id = Authorizer::getResourceOwnerId(); // the token user_id
    $user = \App\User::find($user_id);// get the user data from database

    return Response::json($user);
}]);

Route::group(['prefix'=>'api','before' => 'oauth'], function() {
    Route::get('/posts',  'PostController@index');

});

//Route::group(['prefix' => 'api'], function() {
//    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
//    Route::post('authenticate', 'AuthenticateController@authenticate');
//    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
//});
