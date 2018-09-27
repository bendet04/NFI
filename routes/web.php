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
Auth::routes();
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'Login@logout')->name('logout');
    Route::get('/dashboard', 'Dashboard@index');
    Route::get('/user', 'User@index');
    Route::get('/registerPost', 'User@registerPost');
});
