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

Route::get('/cars', 'CarController@index');
Route::get('/cars/{id}', 'CarController@show');
Route::resource('admin/cars', 'AdminCarController');
Route::post('', 'AdminCarController@store')->name('Admin.store');
Route::put('', 'AdminCarController@update')->name('Admin.update');
Route::resource('admin/booking', 'BookingController');
Route::resource('comments', 'CommentsController');
Route::get('user/{id}', 'UserController@show');
Route::delete('user/{id}', 'UserController@destroy');

Route::get('/frontpage', 'FrontpageController@index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
