<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\User\AddressesController;
use App\Http\Controllers\API\User\OrdersController;
use App\Http\Controllers\API\User\UserDataController;
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

Route::get('', UserDataController::class);
Route::apiResource('orders', OrdersController::class);
Route::apiResource('addresses', AddressesController::class);
Route::post('logout', LogoutController::class);



