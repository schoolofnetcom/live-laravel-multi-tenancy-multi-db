<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/system', 'as' => 'system.'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth:system'], function(){
        Route::get('home', function () {
            return view('system.home');
        });
    });
});

Route::group(['prefix' => '/{prefix}', 'as' => 'tenant.'], function () {
    Auth::routes();

    Route::group(['middleware' => 'auth:tenant'], function(){
        Route::name('home')->get('home', function () {
            return view('tenant.home');
        });
        Route::resource('categories', 'CategoryController');
    });
});


//Route::get('/home', 'HomeController@index')->name('home');
