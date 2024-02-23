<?php

use App\Http\Controllers\Backend\System\SystemAdminMessageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('admin-message/index', [SystemAdminMessageController::class, 'index']);
    Route::any('admin-message/save', [SystemAdminMessageController::class, 'save']);
    Route::any('admin-message/delete', [SystemAdminMessageController::class, 'delete']);
});
