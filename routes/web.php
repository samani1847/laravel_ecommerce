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

Route::get('/', 'HomeController@homepage' );
Route::get('/detailproduct/{id}', 'HomeController@detail');

Auth::routes();

Route::get('/unauthorized', 'HomeController@unauthorized');
Route::get('/coba', 'HomeController@coba');

Route::get('/category/getdata', 'CategoryController@getData');
Route::get('/category/getdetail/{id}', 'CategoryController@getDetail');
Route::put('/category/updatedata/{id}', 'CategoryController@updateData');
Route::post('/category/save', 'CategoryController@save');
Route::delete("/category/deletedata/{id}", 'CategoryController@deleteData');

Route::group(['middleware' => ['auth','permission:Category Management'],'prefix' => '/admin/category'], function () {
    Route::get('/index', 'CategoryController@index');
    
    Route::get('/data', 'CategoryController@data')->name('category_data');
    
    Route::put("/update/{id}", 'CategoryController@update');
    Route::post("/store", 'CategoryController@store');
    
    Route::get("/get/{id}", 'CategoryController@get');
    Route::delete("/delete/{id}", 'CategoryController@delete');
});


Route::get('login/{provider}', 'SocialLoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'SocialLoginController@handleProviderCallback');
Route::get('search', 'HomeController@search');


Route::group(['middleware' => ['auth']], function(){

Route::get('/admin', 'HomeController@index')->name('home');
    Route::delete('/cart/delete/{id}', 'CartController@delete');
    Route::post('/cart/add_to_cart', 'CartController@addToCart');
    Route::get('/cart/loadcart', 'CartController@loadCartView');
    Route::get('/cart/checkout', 'CartController@checkout');
    Route::post("checkout/paywithpaypal", 'TransactionController@paywithPaypal');
    Route::get('/transaction/paypalcancel', 'TransactionController@paypalCancel');
    Route::get('/transaction/paypalproceed', 'TransactionController@paypalProceed');
    Route::get('/transaction/showpaypal/{payment_id}', 'TransactionController@show');
    Route::get('/transaction/showall', 'TransactionController@showtransaction');
});

// Route::get("checkout/paywithpaypal", 'TransactionController@paywithPaypal');