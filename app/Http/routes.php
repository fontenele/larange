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

Route::get('view/{template}', 'EngineController@view')->where('template', '.+');
Route::get('routes', 'EngineController@routes');

Route::get('home', 'HomeController@home');
Route::get('view1', 'HomeController@view1');

// Module admin
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@home');
    
    Route::get('users', 'Admin\UsersController@index')->middleware('permission:users.list');
    Route::get('users/edit/{id?}', 'Admin\UsersController@edit')->middleware('permission:users.edit');
    Route::post('users/remove/{id}', 'Admin\UsersController@destroy')->middleware('permission:users.delete');
    Route::post('users/save', 'Admin\UsersController@save')->middleware('permission:users.edit');
    
    Route::get('roles', 'Admin\RolesController@index');
    Route::get('roles/edit/{id?}', 'Admin\RolesController@edit');
    Route::post('roles/remove/{id}', 'Admin\RolesController@destroy');
    Route::post('roles/save', 'Admin\RolesController@save');
    Route::get('roles/{id}/permissions', 'Admin\RolesController@permissions');
    Route::post('roles/{id}/permissions/save', 'Admin\RolesController@savePermissions');
});
    
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::post('oauth/access_token', function() {
    // Token
    app('request')->json()->set('client_id', 'GXvOWazQ3lA6YSaFji');
    app('request')->json()->set('client_secret', '#.:s.e.c.r.e.t:.#');
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
    // update last login
    $user->updated_at = new DateTime();
    $user->update();
    
    $user->password = '';
    $permissions = $user->permissions();
    \Session::set('user', $user);
    \Session::set('user-p', $permissions);
    
    $user = $user->toArray();
    $user['permissions'] = array_flip($permissions->toArray());
    
    return Response::json($user);
}]);
