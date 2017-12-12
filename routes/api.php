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

Route::get('/test', 'KeyController@test');
Route::get('/key/{key}', 'KeyController@show');
Route::get('/prestamos/{cobro}', 'KeyController@prestamos');
Route::get('/prestamos/{id1}/{id2}/{key}', 'KeyController@add_pago');