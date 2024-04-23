<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\PointController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\RiderController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CustomerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user', UsuarioController::class);
Route::apiResource('point', PointController::class);
Route::apiResource('type', TypeController::class);
Route::apiResource('provider', ProviderController::class);
Route::apiResource('rider', RiderController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('customer', CustomerController::class);