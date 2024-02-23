<?php

use App\Http\Controllers\Backend\System\SystemRoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('role/index', [SystemRoleController::class, 'index']);
    Route::any('role/save', [SystemRoleController::class, 'save']);
    Route::any('role/view', [SystemRoleController::class, 'view']);
    Route::any('role/delete', [SystemRoleController::class, 'delete']);
});
