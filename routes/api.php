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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('players.')->prefix('players')->group(function () {
    Route::get('/', 'PlayerController@index')->name('index');
    Route::post('/', 'PlayerController@store')->name('store');

    Route::prefix('{player}')->group(function () {
        Route::get('/', 'PlayerController@get')->name('get');
        Route::get('/products', 'PlayerController@products')->name('products');
    });
});

Route::name('products.')->prefix('products')->group(function () {
    Route::get('/', 'ProductController@index')->name('index');
});
