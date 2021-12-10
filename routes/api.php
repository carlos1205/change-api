<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'UserController@login');
Route::post('/create', 'UserController@create');

Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::put('/update', 'UserController@update');
    Route::delete('/{id}/delete', 'UserController@delete');
});

Route::middleware('auth:api')->prefix('types')->group(function(){
    Route::get("/", 'TypeController@getAll');
    Route::get("/{id}", 'TypeController@get'); 
    Route::post("/create", 'TypeController@create');
    Route::put("/{id}/update", 'TypeController@update');
    Route::delete("/{id}/delete", 'TypeController@delete');
});

Route::middleware('auth:api')->prefix('items')->group(function(){
    Route::get("/", 'ItemController@getAll');
    Route::get("/{id}", 'ItemController@get'); 
    Route::post("/create", 'ItemController@create');
    Route::put("/{id}/update", 'ItemController@update');
    Route::delete("/{id}/delete", 'ItemController@delete');
});