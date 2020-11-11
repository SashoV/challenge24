<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/vehicles', 'VehiclesController@index');
Route::middleware('auth:api')->get('/vehicles/show', 'VehiclesController@show')->name('show');
Route::middleware('auth:api')->post('/vehicles/store', 'VehiclesController@store')->name('store');
Route::middleware('auth:api')->put('/vehicles/update', 'VehiclesController@update')->name('update');
Route::middleware('auth:api')->delete('/vehicles/delete', 'VehiclesController@destroy')->name('delete');
Route::middleware('auth:api')->put('/vehicles/register', 'VehiclesController@register')->name('register');
