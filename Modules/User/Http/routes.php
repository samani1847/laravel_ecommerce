<?php

Route::group(['middleware' => ['web', 'auth','permission:User Management'], 'prefix' => 'admin/user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
    Route::get('/index', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::get('/edit/{id}', 'UserController@edit');
    
    Route::post('/data', 'UserController@data');
    
    Route::put("/update/{id}", 'UserController@update');
    Route::post("/store", 'UserController@store');
    
    Route::get("/get/{id}", 'UserController@get');
    Route::delete("/delete/{id}", 'UserController@delete');
});
