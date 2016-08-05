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
Route::post('admin', 'AdminController@home');
Route::post('admin/users', 'AdminController@users');
Route::post('admin/users/edit/{id}', 'AdminController@editUser');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::post('oauth/access_token', function() {
    // Token
    app('request')->json()->set('client_id', 'GXvOWazQ3lA6YSaFji');
    app('request')->json()->set('client_secret', 'abcd');
    app('request')->json()->set('grant_type', 'password');
    app('request')->json()->set('username', app('request')->json()->get('email'));
    $response = Authorizer::issueAccessToken();
    $response['token'] = $response['access_token'];
    return Response::json($response);
});

Route::post('oauth/user', ['before' => 'oauth', function() {
    // return the protected resource
    $user_id = Authorizer::getResourceOwnerId(); // the token user_id
    $user = \App\User::find($user_id);// get the user data from database
    return Response::json($user);
}]);
