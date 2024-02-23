<?php

use App\Http\Controllers\Backend\System\SystemImageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('image/index', [SystemImageController::class, 'index']);
    Route::any('image/save', [SystemImageController::class, 'save']);
    Route::any('image/delete', [SystemImageController::class, 'delete']);
});
