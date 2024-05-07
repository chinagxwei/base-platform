<?php

use App\Http\Controllers\Backend\Member\MemberController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/member'

], function ($router) {
    Route::any('index', [MemberController::class, 'index']);
//    Route::any('save', [MemberController::class, 'save']);
    Route::any('view', [MemberController::class, 'view']);
    Route::any('delete', [MemberController::class, 'delete']);
});
