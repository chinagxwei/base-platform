<?php


use App\Http\Controllers\Backend\Wallet\WalletFundController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('fund/index', [WalletFundController::class, 'index']);
    Route::any('fund/save', [WalletFundController::class, 'save']);
    Route::any('fund/view', [WalletFundController::class, 'view']);
    Route::any('fund/delete', [WalletFundController::class, 'delete']);
});
