<?php

use App\Http\Controllers\Backend\System\SystemAdminController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('manager/index', [SystemAdminController::class, 'index']);
    Route::any('manager/save', [SystemAdminController::class, 'save']);
    Route::any('manager/delete', [SystemAdminController::class, 'delete']);
});
