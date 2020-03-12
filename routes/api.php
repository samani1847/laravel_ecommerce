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


Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
    Route::get('category/index', 'CategoryController@index' );
});

Route::group(['middleware' => ['api', 'cors']], function () {
  
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::get('homepage', 'HomeController@homedata');
    Route::get('detail/{id}', 'API\ApiProductController@detail');
    Route::post('cart/add', 'API\ApiCartController@addToCart');

});
