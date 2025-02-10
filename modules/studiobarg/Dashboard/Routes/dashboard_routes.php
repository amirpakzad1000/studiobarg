<?php

use Illuminate\Support\Facades\Route;
use studiobarg\Dashboard\Http\Controllers\DashboardController;

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
});



