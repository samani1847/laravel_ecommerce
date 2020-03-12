<?php

Route::group(['middleware' => ['web','auth','permission:Voucher Management'], 'prefix' => '/admin/voucher', 'namespace' => 'Modules\Voucher\Http\Controllers'], function()
{
    Route::get('/', 'VoucherController@index');
    Route::get('/index', 'VoucherController@index');
    Route::get('/create', 'VoucherController@create');
    Route::get('/edit/{id}', 'VoucherController@edit');
    
    Route::post('/data', 'VoucherController@data')->name('voucher_data');
    
    Route::put("/update/{id}", 'VoucherController@update');
    Route::post("/store", 'VoucherController@store');
  
    Route::get("/get/{id}", 'VoucherController@get');
    Route::delete("/delete/{id}", 'VoucherController@delete');
});


Route::group(['middleware' => ['web'], 'prefix' => 'voucher', 'namespace' => 'Modules\Voucher\Http\Controllers'], function()
{
    Route::post('/check', 'VoucherController@check');
});