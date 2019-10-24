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


        /**
     * Projects Resource Routes
     */

    Route::resource('project', 'ProjectController', [
        'only' => $defaultResources
    ]);

            /**
     * Obres Resource Routes
     */

    Route::resource('obre', 'ObreController', [
        'only' => $defaultResources
    ]);

        /**
     * Employee Resource Routes
     */

    Route::resource('employee', 'EmployeeController', [
        'only' => $defaultResources
    ]);

        /**
     * Warehouse Resource Routes
     */

    Route::resource('warehouse', 'WarehouseController', [
        'only' => $defaultResources
    ]);

        /**
     * Inventary Resource Routes
     */

    Route::resource('inventary', 'InventaryController', [
        'only' => $defaultResources
    ]);

        /**
     * InputMaterial Resource Routes
     */

    Route::resource('inputmaterial', 'InputMaterialController', [
        'only' => $defaultResources
    ]);

            /**
     * OutputMaterial Resource Routes
     */

    Route::resource('outputmaterial', 'OutputMaterialController', [
        'only' => $defaultResources
    ]);

                /**
     * OutputMaterial Resource Routes
     */

    Route::resource('requirementmaterial', 'RequirementMaterialController', [
        'only' => $defaultResources
    ]);

                /**
     * Activitys Resource Routes
     */

    Route::resource('activity', 'ActivityController', [
        'only' => $defaultResources
    ]);

                /**
     * Tools Resource Routes
     */

    Route::resource('tool', 'ToolController', [
        'only' => $defaultResources
    ]);
});
