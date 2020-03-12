<?php

Route::group(['middleware' => ['web', 'auth','permission:Role Management'], 'prefix' => 'admin/role', 'namespace' => 'Modules\Role\Http\Controllers'], function()
{
    Route::get('/', 'RoleController@index');
    Route::get('/index', 'RoleController@index');
    Route::get('/create', 'RoleController@create');
    Route::get('/edit/{id}', 'RoleController@edit');
    
    Route::post('/data', 'RoleController@data');
    
    Route::put("/update/{id}", 'RoleController@update');
    Route::post("/store", 'RoleController@store');
    
    Route::get("/get/{id}", 'RoleController@get');
    Route::delete("/delete/{id}", 'RoleController@delete');
});
