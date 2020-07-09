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

Route::group(['prefix' => 'setup'], function()
{
	Route::resource('supplier','Api\SupplierController');
	Route::resource('item','Api\ItemController');
	Route::resource('order','Api\OrderController');
	Route::resource('admin','Api\UserController');
	Route::resource('supplier','Api\SupplierController');
	Route::resource('customer','Api\CustomerController');
});
