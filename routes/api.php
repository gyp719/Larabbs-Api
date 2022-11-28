<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VerificationCodesController;

Route::prefix('v1')->name('api.v1.')->group(function() {
    // 短信验证码
    Route::post('verificationCodes', [VerificationCodesController::class, 'store'])->name('verificationCodes.store');
});
