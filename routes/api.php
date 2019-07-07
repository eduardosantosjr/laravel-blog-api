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
    Route::post('posts/search', 'PostController@search')->name('blog.post.search');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('details', 'UserController@details')->name('auth.user.details');
        Route::get('logout', 'UserController@logout')->name('auth.user.logout');

        Route::group(['prefix' => 'posts', 'where' => ['id' => '[0-9]+']], function () {
            Route::get('', 'PostController@list')->name('blog.post.list');
            Route::post('store', 'PostController@store')->name('blog.post.store');
            Route::get('{id}/show', 'PostController@show')->name('blog.post.show');
            Route::put('{id}/publish', 'PostController@publish')->name('blog.post.publish');
            Route::put('{id}/unpublish', 'PostController@unpublish')->name('blog.post.unpublish');
            Route::delete('{id}/delete', 'PostController@delete')->name('blog.post.delete');
        });
    });
});
