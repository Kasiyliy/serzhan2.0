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

Auth::routes();

Route::get('/home', ['as' => 'home' , 'uses' => 'HomeController@index']);
Route::get('/categories', ['as' => 'category.index' , 'uses' => 'CategoryController@index']);
Route::get('/categories/create', ['as' => 'category.create' , 'uses' => 'CategoryController@create']);
Route::post('/categories/store', ['as' => 'category.store' , 'uses' => 'CategoryController@store']);

Route::get('/statuses', ['as' => 'status.index' , 'uses' => 'StatusController@index']);
Route::get('/statuses/create', ['as' => 'status.create' , 'uses' => 'StatusController@create']);
Route::post('/statuses/store', ['as' => 'status.store' , 'uses' => 'StatusController@store']);