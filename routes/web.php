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
Route::get('/', function(){
    return redirect()->route('login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', ['as' => 'home' , 'uses' => 'HomeController@index']);

    Route::group(['middleware' => 'admin'], function(){

        Route::get('/statuses', ['as' => 'status.index' , 'uses' => 'StatusController@index']);
        Route::get('/statuses/edit/{id}', ['as' => 'status.edit' , 'uses' => 'StatusController@edit'])->where('id', '[0-9]+');
        Route::post('/statuses/update/{id}', ['as' => 'status.update' , 'uses' => 'StatusController@update'])->where('id', '[0-9]+');


        Route::get('/users', ['as' => 'user.index' , 'uses' => 'UserController@index']);
        Route::get('/users/create', ['as' => 'user.create' , 'uses' => 'UserController@create']);
        Route::post('/users/store', ['as' => 'user.store' , 'uses' => 'UserController@store']);
        Route::get('/users/edit/{id}', ['as' => 'user.edit' , 'uses' => 'UserController@edit'])->where('id', '[0-9]+');
        Route::post('/users/update/{id}', ['as' => 'user.update' , 'uses' => 'UserController@update'])->where('id', '[0-9]+');
        Route::post('/users/updatePassword/{id}', ['as' => 'user.updatePassword' , 'uses' => 'UserController@updatePassword'])->where('id', '[0-9]+');
        Route::post('/users/delete/{id}', ['as' => 'user.delete' , 'uses' => 'UserController@delete'])->where('id', '[0-9]+');


        Route::get('/items/create', ['as' => 'item.create' , 'uses' => 'ItemController@create']);
        Route::post('/items/store', ['as' => 'item.store' , 'uses' => 'ItemController@store']);
        Route::get('/items/edit/{id}', ['as' => 'item.edit' , 'uses' => 'ItemController@edit'])->where('id', '[0-9]+');
        Route::post('/items/update/{id}', ['as' => 'item.update' , 'uses' => 'ItemController@update'])->where('id', '[0-9]+');
        Route::post('/items/delete/{id}', ['as' => 'item.delete' , 'uses' => 'ItemController@delete'])->where('id', '[0-9]+');


        Route::get('/clients/create', ['as' => 'client.create' , 'uses' => 'ClientController@create']);
        Route::post('/clients/store', ['as' => 'client.store' , 'uses' => 'ClientController@store']);
        Route::post('/clients/delete/{id}',['as'=>'client.delete','uses'=>'ClientController@delete'])->where('id', '[0-9]+');
        Route::get('/clients/edit/{id}',['as'=>'client.edit','uses'=>'ClientController@edit'])->where('id', '[0-9]+');
        Route::post('/clients/update/{id}', ['as' => 'client.update' , 'uses' => 'ClientController@update'])->where('id', '[0-9]+');


        Route::get('/roles', ['as' => 'role.index' , 'uses' => 'RoleController@index']);
        Route::get('/roles/edit/{id}', ['as' => 'role.edit' , 'uses' => 'RoleController@edit'])->where('id', '[0-9]+');
        Route::post('/roles/update/{id}', ['as' => 'role.update' , 'uses' => 'RoleController@update'])->where('id', '[0-9]+');

        Route::post('/debtors/update/{id}', ['as' => 'debtor.update' , 'uses' => 'DebtorController@update'])->where('id', '[0-9]+');
        Route::get('/debtors/edit/{id}', ['as' => 'debtor.edit' , 'uses' => 'DebtorController@edit'])->where('id', '[0-9]+');
        Route::post('/debtors/delete/{id}', ['as' => 'debtor.delete' , 'uses' => 'DebtorController@delete'])->where('id', '[0-9]+');


        Route::get('/categories/create', ['as' => 'category.create' , 'uses' => 'CategoryController@create']);
        Route::post('/categories/store', ['as' => 'category.store' , 'uses' => 'CategoryController@store']);
        Route::post('/categories/delete/{id}', ['as' => 'category.delete' , 'uses' => 'CategoryController@delete'])->where('id', '[0-9]+');
        Route::get('/categories/edit/{id}', ['as' => 'category.edit' , 'uses' => 'CategoryController@edit'])->where('id', '[0-9]+');
        Route::post('/categories/update/{id}', ['as' => 'category.update' , 'uses' => 'CategoryController@update'])->where('id', '[0-9]+');


    });

    Route::get('/items', ['as' => 'item.index' , 'uses' => 'ItemController@index']);
    Route::get('/clients', ['as' => 'client.index' , 'uses' => 'ClientController@index']);
    Route::get('/categories', ['as' => 'category.index' , 'uses' => 'CategoryController@index']);

    Route::get('/debtors', ['as' => 'debtor.index' , 'uses' => 'DebtorController@index']);
    Route::get('/debtors/create', ['as' => 'debtor.create' , 'uses' => 'DebtorController@create']);
    Route::post('/debtors/store', ['as' => 'debtor.store' , 'uses' => 'DebtorController@store']);

    Route::get('/orders',['as' => 'order.index', 'uses' => 'OrderController@index']);
    Route::get('/orders/create',['as' => 'order.create', 'uses' => 'OrderController@create']);
    Route::post('/orders/store',['as' => 'order.store', 'uses' => 'OrderController@store']);
    Route::post('/orders/accept/{id}',['as' => 'order.accept', 'uses' => 'OrderController@accept']);
    Route::get('/orders/show/{id}',['as' => 'order.show', 'uses' => 'OrderController@show']);
    Route::get('/orders/edit/{id}',['as' => 'order.edit', 'uses' => 'OrderController@edit']);
    Route::post('/orders/delete/{id}', ['as' => 'order.delete' , 'uses' => 'OrderController@delete'])->where('id', '[0-9]+');

});
