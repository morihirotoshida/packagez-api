<?php

use App\Http\Controllers\Api\LicenseController;

// ---------------------------------------------------------
// dispatcherZ 製品版ライセンス認証API
// ---------------------------------------------------------

// 1. PINコードの要求（メール送信）
Route::post('/license/request-pin', [LicenseController::class, 'requestPin']);

// 2. アクティベーション（制限解除キーの発行）
Route::post('/license/activate', [LicenseController::class, 'activate']);