<?php

require_once "log.php";
require_once "fund.php";
require_once "consume.php";
require_once "withdrawal.php";
require_once "withdrawal-account.php";

use App\Http\Controllers\Backend\Wallet\WalletController;
use Illuminate\Support\Facades\Route;
Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/wallet'

], function ($router) {
    Route::any('index', [WalletController::class, 'index']);
    Route::any('save', [WalletController::class, 'save']);
    Route::any('view', [WalletController::class, 'view']);
    Route::any('delete', [WalletController::class, 'delete']);
});
