<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'v1', 'prefix' => 'v1'], function () {

    Route::post('login', 'UserController@login')->name('auth.user.login');
    Route::post('register', 'UserController@register')->name('auth.user.register');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('details', 'UserController@details')->name('auth.user.details');
        Route::get('logout', 'UserController@logout')->name('auth.user.logout');
    });
});
