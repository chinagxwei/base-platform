<?php

use App\Http\Controllers\Backend\Business\AreaController;
use App\Http\Controllers\Backend\Business\ScheduleController;
use App\Http\Controllers\Backend\Business\VenueController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/system'

], function ($router) {
    Route::any('area/index', [AreaController::class, 'index']);
    Route::any('area/save', [AreaController::class, 'save']);
    Route::any('area/view', [AreaController::class, 'view']);
    Route::any('area/delete', [AreaController::class, 'delete']);

    Route::any('venue/index', [VenueController::class, 'index']);
    Route::any('venue/save', [VenueController::class, 'save']);
    Route::any('venue/view', [VenueController::class, 'view']);
    Route::any('venue/delete', [VenueController::class, 'delete']);

    Route::any('schedule/index', [ScheduleController::class, 'index']);
    Route::any('schedule/save', [ScheduleController::class, 'save']);
    Route::any('schedule/view', [ScheduleController::class, 'view']);
    Route::any('schedule/delete', [ScheduleController::class, 'delete']);
});
