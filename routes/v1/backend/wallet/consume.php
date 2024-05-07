<?php


use App\Http\Controllers\Backend\Wallet\WalletConsumeController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('consume/index', [WalletConsumeController::class, 'index']);
    Route::any('consume/save', [WalletConsumeController::class, 'save']);
    Route::any('consume/view', [WalletConsumeController::class, 'view']);
    Route::any('consume/delete', [WalletConsumeController::class, 'delete']);
});
