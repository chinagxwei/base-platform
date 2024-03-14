<?php

use App\Http\Controllers\Backend\Product\VipController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('router/index', [VipController::class, 'index']);
    Route::any('router/view', [VipController::class, 'view']);
    Route::any('router/save', [VipController::class, 'save']);
    Route::any('router/delete', [VipController::class, 'delete']);
});
