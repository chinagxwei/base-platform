<?php

use App\Http\Controllers\Backend\Member\MemberMessageController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/member'

], function ($router) {
    Route::any('message/index', [MemberMessageController::class, 'index']);
    Route::any('message/save', [MemberMessageController::class, 'save']);
    Route::any('message/view', [MemberMessageController::class, 'view']);
    Route::any('message/delete', [MemberMessageController::class, 'delete']);
});
