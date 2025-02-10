<?php

use studiobarg\User\Http\Controllers\Auth\AuthenticatedSessionController;
use studiobarg\User\Http\Controllers\Auth\EmailVerificationNotificationController;
use studiobarg\User\Http\Controllers\Auth\EmailVerificationPromptController;
use studiobarg\User\Http\Controllers\Auth\NewPasswordController;
use studiobarg\User\Http\Controllers\Auth\PasswordResetLinkController;
use studiobarg\User\Http\Controllers\Auth\RegisteredUserController;
use studiobarg\User\Http\Controllers\Auth\VerifyEmailController;
use studiobarg\User\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'middleware' => ['web']], function () {

    //login logout
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //register
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    //password
    Route::get('/password/reset', [PasswordResetLinkController::class, 'showVerifyCodeRequestForm'])
        ->name('password.request');
    Route::get('/password/reset/send', [PasswordResetLinkController::class, 'sendVerifyCodeEmail'])
        ->name('password.sendVerifyCodeEmail');

    Route::post('/password/reset/check-verify-code', [PasswordResetLinkController::class, 'checkVerifyCode'])
        ->name('password.checkVerifyCode')
        ->middleware('throttle:5,1');
    Route::get('/password/change', [NewPasswordController::class, 'showResetForm'])
        ->name('password.showResetForm')
        ->middleware('auth');
    Route::post('/password/change', [NewPasswordController::class, 'reset'])->name('password.update');
    //verify-email
    Route::get('/verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::post('/verify-email', [VerifyEmailController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');

});
