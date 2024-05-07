<?php

use App\Http\Controllers\Backend\System\SystemTagController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('tag/index', [SystemTagController::class, 'index']);
    Route::any('tag/save', [SystemTagController::class, 'save']);
    Route::any('tag/view', [SystemTagController::class, 'view']);
    Route::any('tag/delete', [SystemTagController::class, 'delete']);
});
