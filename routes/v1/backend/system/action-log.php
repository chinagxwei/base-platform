<?php

use App\Http\Controllers\Backend\System\ActionLogController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('log/index', [ActionLogController::class, 'index']);
});
