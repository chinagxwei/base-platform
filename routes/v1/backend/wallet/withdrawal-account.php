<?php
use App\Http\Controllers\Backend\Wallet\WalletWithdrawalAccountController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('withdrawal-account/index', [WalletWithdrawalAccountController::class, 'index']);
    Route::any('withdrawal-account/save', [WalletWithdrawalAccountController::class, 'save']);
    Route::any('withdrawal-account/view', [WalletWithdrawalAccountController::class, 'view']);
    Route::any('withdrawal-account/delete', [WalletWithdrawalAccountController::class, 'delete']);
});
