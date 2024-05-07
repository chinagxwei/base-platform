<?php


use App\Http\Controllers\Backend\Wallet\WalletFundController;
use App\Http\Controllers\Backend\Wallet\WalletWithdrawalController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('withdrawal/index', [WalletWithdrawalController::class, 'index']);
    Route::any('withdrawal/save', [WalletWithdrawalController::class, 'save']);
    Route::any('withdrawal/view', [WalletWithdrawalController::class, 'view']);
    Route::any('withdrawal/delete', [WalletWithdrawalController::class, 'delete']);
});
