<?php

use App\Http\Controllers\Backend\System\SystemRouterController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('router/index', [SystemRouterController::class, 'index']);
    Route::any('router/save', [SystemRouterController::class, 'save']);
    Route::any('router/delete', [SystemRouterController::class, 'delete']);
    Route::any('router/registered-route', [SystemRouterController::class, 'registeredRoute']);
});
