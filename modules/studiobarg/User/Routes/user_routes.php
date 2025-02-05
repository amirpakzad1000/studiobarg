<?php
use studiobarg\User\HTTP\Controllers\ProfileController;
use studiobarg\User\HTTP\Controllers\Auth\VerifyEmailController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'namespace'=>'studiobarg\User\HTTP\Controllers',
    'middleware' => ['web']], function ($router) {
    require __DIR__ . '/auth.php';
    Route::post('/verify-email', [VerifyEmailController::class, 'verify'])->name('verification.verify');
});
