<?php

use App\Http\Controllers\Backend\System\SystemMessageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('message/index', [SystemMessageController::class, 'index']);
    Route::any('message/index', [SystemMessageController::class, 'save']);
    Route::any('message/index', [SystemMessageController::class, 'view']);
    Route::any('message/index', [SystemMessageController::class, 'delete']);
    Route::any('message/index', [SystemMessageController::class, 'send']);
});
