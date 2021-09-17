<?php

use Illuminate\Http\Request;

$defaultResources = ['index', 'show', 'store', 'update', 'destroy'];



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\Controllers\AuthController@login');
    Route::post('login-app', 'Auth\Controllers\AuthController@loginApp');
    Route::post('register', 'Auth\Controllers\AuthController@register');
    Route::post('logout', 'Auth\Controllers\AuthController@logout');
    Route::post('refresh', 'Auth\Controllers\AuthController@refresh');
    Route::post('user', 'Auth\Controllers\AuthController@user');
    Route::post('recover-password/{email}', 'Auth\Controllers\AuthController@forgotPassword');
}); 



  Route::group([
    'middleware' => 'api',
], function() use ($defaultResources){


    Route::resource('user', 'User\Controllers\UserController', [
        'only' => $defaultResources
    ]);

    /*Route::resource('employee', 'EmployeeController', [
        'only' => $defaultResources
    ]);*/

   
});
