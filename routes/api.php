<?php

use Illuminate\Http\Request;

$defaultResources = ['index', 'show', 'store', 'update', 'destroy'];



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    secure_url(Route::post('login', 'Auth\Controllers\AuthController@login',[], false));
    secure_url(Route::post('login-app', 'Auth\Controllers\AuthController@loginApp',[], false));
    secure_url(Route::post('register', 'Auth\Controllers\AuthController@register',[], false));
    secure_url(Route::post('logout', 'Auth\Controllers\AuthController@logout',[], false));
    secure_url(Route::post('refresh', 'Auth\Controllers\AuthController@refresh',[], false));
    secure_url(Route::post('user', 'Auth\Controllers\AuthController@user',[], false));
    secure_url(Route::post('recover-password/{email}', 'Auth\Controllers\AuthController@forgotPassword',[], false));
}); 



  Route::group([
    'middleware' => 'api',
], function() use ($defaultResources){


    secure_url(Route::resource('user', 'User\Controllers\UserController', [
        'only' => $defaultResources
    ],[], false));

    /*Route::resource('employee', 'EmployeeController', [
        'only' => $defaultResources
    ]);*/

   
});
