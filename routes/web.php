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

//ユーザー側
Route::get('/shop', 'ShopController@index');
Route::post('/shop/{id}','ShopController@item_insert'); 
Route::get('/shop/cart','CartController@index');
Route::patch('/shop/cart/{id}', 'CartController@update');
Route::delete('/shop/cart/{id}', 'CartController@delete');
Route::post('/shop/cart/complete', 'CartController@store');

//管理側
Route::get('/cms', 'CmsController@index');
Route::post('/cms', 'CmsController@store');
Route::delete('/cms/{id}', 'CmsController@destroy');
Route::patch('/cms/{id}/{name}', 'CmsController@update');



Auth::routes();

Route::get('/home', 'HomeController@index');
