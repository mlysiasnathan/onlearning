<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiNewPasswordController;
use App\Http\Controllers\Auth\ApiVerifyEmailController;
use App\Http\Controllers\Auth\ApiRegisteredUserController;
use App\Http\Controllers\Auth\ApiPasswordResetLinkController;
use App\Http\Controllers\Auth\ApiConfirmablePasswordController;
use App\Http\Controllers\Auth\ApiAuthenticatedSessionController;
use App\Http\Controllers\Auth\ApiEmailVerificationPromptController;
use App\Http\Controllers\Auth\ApiEmailVerificationNotificationController;


Route::middleware('guest')->group(function () {
    Route::get('register', [ApiRegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [ApiRegisteredUserController::class, 'store']);

    Route::get('login', [ApiAuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [ApiAuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [ApiPasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [ApiPasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [ApiNewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [ApiNewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [ApiEmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [ApiVerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [ApiEmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ApiConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ApiConfirmablePasswordController::class, 'store']);

    Route::post('logout', [ApiAuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
