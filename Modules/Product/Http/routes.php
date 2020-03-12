<?php

Route::group(['middleware' => ['web','auth','permission:Product Management'], 'prefix' => 'admin/product', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
    Route::get('/', 'ProductController@index');
    Route::get('/index', 'ProductController@index');
    Route::get('/create', 'ProductController@create');
    Route::get('/edit/{id}', 'ProductController@edit');
    
    Route::get('/data', 'ProductController@data');
    
    Route::put("/update/{id}", 'ProductController@update');
    Route::post("/store", 'ProductController@store');
    
    Route::get("/get/{id}", 'ProductController@get');
    Route::delete("/delete/{id}", 'ProductController@delete');
});
