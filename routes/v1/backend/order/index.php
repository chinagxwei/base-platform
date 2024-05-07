<?php

use App\Http\Controllers\Backend\Order\OrderController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/order'

], function ($router) {
    Route::any('index', [OrderController::class, 'index']);
//    Route::any('save', [OrderController::class, 'save']);
    Route::any('view', [OrderController::class, 'view']);
    Route::any('delete', [OrderController::class, 'delete']);
});
