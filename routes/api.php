<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('signin', [AuthController::class, 'signIn']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::group(['prefix' => 'orders'], function () {
            Route::get('list', [OrderController::class, 'getOrders']);
            Route::post('create', [OrderController::class, 'create']);
            Route::post('cancel', [OrderController::class, 'cancel']);
        });
    });
});
