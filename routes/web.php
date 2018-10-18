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
//Cars


Route::resource('/cars', 'CarController');
Route::resource('/admin/cars', 'AdminCarController');
Route::post('', 'AdminCarController@store')->name('AdminCar.store');
Route::resource('/admin/users', 'AdminUserController');
Route::resource('/admin/booking', 'BookingController');
Route::get('user/{id}', 'UserController@show');
Route::delete('user/{id}', 'UserController@destroy');

Route::get('/', 'FrontpageController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
