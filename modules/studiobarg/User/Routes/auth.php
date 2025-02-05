<?php

use Illuminate\Support\Facades\Route;
use studiobarg\User\HTTP\Controllers\Auth\AuthenticatedSessionController;
use studiobarg\User\HTTP\Controllers\Auth\ConfirmablePasswordController;
use studiobarg\User\HTTP\Controllers\Auth\EmailVerificationNotificationController;
use studiobarg\User\HTTP\Controllers\Auth\EmailVerificationPromptController;
use studiobarg\User\HTTP\Controllers\Auth\NewPasswordController;
use studiobarg\User\HTTP\Controllers\Auth\PasswordController;
use studiobarg\User\HTTP\Controllers\Auth\PasswordResetLinkController;
use studiobarg\User\HTTP\Controllers\Auth\RegisteredUserController;
use studiobarg\User\HTTP\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
