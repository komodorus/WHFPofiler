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

Route::get('/', 'ProfileController@index');

Route::get('/profile', 'ProfileController@show')->name('profile');
Route::patch('/profile/{id}', 'ProfileController@update')->name('profile.update');

Route::post('profile/image', 'ImageController@store');