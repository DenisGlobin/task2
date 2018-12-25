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
Auth::routes(['verify' => true]);

// User routes
Route::get('/home', 'UserController@index')->name('home')->middleware('auth','verified');
Route::post('/', 'UserController@addOrder')->name('/orders/add')->middleware('auth','verified');
// Admin routes
Route::get('/', 'AdminController@index')->name('orders')->middleware('auth', 'admin');
Route::post('/orders/processed', 'AdminController@processedOrders')->name('processed')->middleware('auth', 'admin');
