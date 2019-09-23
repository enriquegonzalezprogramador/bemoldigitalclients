<?php

use Illuminate\Http\Request;

$defaultResources = ['index', 'show', 'store', 'update', 'destroy'];

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('login-app', 'AuthController@loginApp');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@user');
    Route::post('recover-password/{email}', 'AuthController@forgotPassword');
});

Route::group([
    'middleware' => 'api'
], function() use ($defaultResources){

    /**
     * User Resource Routes
     */

    Route::resource('user', 'UserController', [
        'only' => $defaultResources
    ]);
});
