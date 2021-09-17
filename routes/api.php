<?php

use Illuminate\Http\Request;

$defaultResources = ['index', 'show', 'store', 'update', 'destroy'];



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    secure_url(Route::post('login', 'Auth\Controllers\AuthController@login'));
    secure_url(Route::post('login-app', 'Auth\Controllers\AuthController@loginApp'));
    secure_url(Route::post('register', 'Auth\Controllers\AuthController@register'));
    secure_url(Route::post('logout', 'Auth\Controllers\AuthController@logout'));
    secure_url(Route::post('refresh', 'Auth\Controllers\AuthController@refresh'));
    secure_url(Route::post('user', 'Auth\Controllers\AuthController@user'));
    secure_url(Route::post('recover-password/{email}', 'Auth\Controllers\AuthController@forgotPassword'));
}); 



  Route::group([
    'middleware' => 'api',
], function() use ($defaultResources){


    secure_url(Route::resource('user', 'User\Controllers\UserController', [
        'only' => $defaultResources
    ]));

    /*Route::resource('employee', 'EmployeeController', [
        'only' => $defaultResources
    ]);*/

   
});
