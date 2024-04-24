<?php

use App\Http\Controllers\Backend\System\SystemEnterpriseController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('enterprise/index', [SystemEnterpriseController::class, 'index']);
    Route::any('enterprise/save', [SystemEnterpriseController::class, 'save']);
    Route::any('enterprise/delete', [SystemEnterpriseController::class, 'delete']);
});
