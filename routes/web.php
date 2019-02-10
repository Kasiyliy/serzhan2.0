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
Route::post('/categories/delete/{id}', ['as' => 'category.delete' , 'uses' => 'CategoryController@delete']);
Route::get('/categories/edit/{id}', ['as' => 'category.edit' , 'uses' => 'CategoryController@edit']);
Route::post('/categories/update/{id}', ['as' => 'category.update' , 'uses' => 'CategoryController@update']);

Route::get('/statuses', ['as' => 'status.index' , 'uses' => 'StatusController@index']);
Route::get('/statuses/create', ['as' => 'status.create' , 'uses' => 'StatusController@create']);
Route::post('/statuses/store', ['as' => 'status.store' , 'uses' => 'StatusController@store']);
Route::post('/statuses/delete/{id}', ['as' => 'status.delete' , 'uses' => 'StatusController@delete']);
Route::get('/statuses/edit/{id}', ['as' => 'status.edit' , 'uses' => 'StatusController@edit']);
Route::post('/statuses/update/{id}', ['as' => 'status.update' , 'uses' => 'StatusController@update']);



Route::get('/clients', ['as' => 'client.index' , 'uses' => 'ClientController@index']);
Route::get('/clients/create', ['as' => 'client.create' , 'uses' => 'ClientController@create']);
Route::post('/clients/store', ['as' => 'client.store' , 'uses' => 'ClientController@store']);
Route::post('/clients/delete/{id}',['as'=>'client.delete','uses'=>'ClientController@delete']);
Route::get('/clients/edit/{id}',['as'=>'client.edit','uses'=>'ClientController@edit']);
Route::post('/clients/update/{id}', ['as' => 'client.update' , 'uses' => 'ClientController@update']);

Route::get('/roles', ['as' => 'role.index' , 'uses' => 'RoleController@index']);
Route::get('/roles/create', ['as' => 'role.create' , 'uses' => 'RoleController@create']);
Route::post('/roles/store', ['as' => 'role.store' , 'uses' => 'RoleController@store']);