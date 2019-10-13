<?php

use Illuminate\Http\Request;
use App\User;

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

Route::middleware(['prefix' => 'api'])->middleware("auth:api")->group(function(){
    Route::get('users', function() {
        return User::all();
    });
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{id}', 'OrderController@show');
    Route::put('orders', 'OrderController@store');
    Route::post('orders/{id}', 'OrderController@update');
    Route::delete('orders/{id}', 'OrderController@destroy');
    Route::get('order-possible-states', 'OrderController@getOrderPossibleStates');
    Route::get('products', 'ProductController@index');
});