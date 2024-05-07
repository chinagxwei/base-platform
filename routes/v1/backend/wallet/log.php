<?php


use App\Http\Controllers\Backend\Wallet\WalletLogController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('log/index', [WalletLogController::class, 'index']);
    Route::any('log/save', [WalletLogController::class, 'save']);
    Route::any('log/view', [WalletLogController::class, 'view']);
    Route::any('log/delete', [WalletLogController::class, 'delete']);
});
