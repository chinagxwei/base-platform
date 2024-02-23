<?php

use App\Http\Controllers\Backend\System\SystemNavigationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('navigation/index', [SystemNavigationController::class, 'index']);
    Route::any('navigation/save', [SystemNavigationController::class, 'save']);
    Route::any('navigation/delete', [SystemNavigationController::class, 'delete']);
    Route::any('navigation/all', [SystemNavigationController::class, 'allMenu']);
    Route::any('navigation/sort-change', [SystemNavigationController::class, 'sortChange']);
});
