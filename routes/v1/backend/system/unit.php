<?php

use App\Http\Controllers\Backend\Util\UnitController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('unit/index', [UnitController::class, 'index']);
    Route::any('unit/save', [UnitController::class, 'save']);
    Route::any('unit/view', [UnitController::class, 'view']);
    Route::any('unit/delete', [UnitController::class, 'delete']);
});
