<?php

use App\Http\Controllers\Backend\Enterprise\EnterpriseController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('enterprise/index', [EnterpriseController::class, 'index']);
    Route::any('enterprise/save', [EnterpriseController::class, 'save']);
    Route::any('enterprise/delete', [EnterpriseController::class, 'delete']);
});
