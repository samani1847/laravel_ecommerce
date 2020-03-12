<?php

Route::group(['middleware' =>['web', 'auth','permission:Subcategory Management'], 'prefix' => '/admin/subcategory', 'namespace' => 'Modules\Subcategory\Http\Controllers'], function()
{
    Route::get('/index', 'SubcategoryController@index');
    
    Route::get('/data', 'SubcategoryController@data')->name('category_data');
    
    Route::put("/update/{id}", 'SubcategoryController@update');
    Route::post("/store", 'SubcategoryController@store');
    
    Route::get("/get/{id}", 'SubcategoryController@get');
    Route::delete("/delete/{id}", 'SubcategoryController@delete');
});
