<?php

use App\Http\Controllers\Backend\System\SystemRoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('role/index', [SystemRoleController::class, 'index']);
    Route::post('role/save', [SystemRoleController::class, 'save']);
    Route::any('role/view', [SystemRoleController::class, 'view']);
    Route::post('role/delete', [SystemRoleController::class, 'delete']);
    Route::post('role/set-navigation', [SystemRoleController::class, 'setNavigation']);
    Route::post('role/set-router', [SystemRoleController::class, 'setRouter']);
});
