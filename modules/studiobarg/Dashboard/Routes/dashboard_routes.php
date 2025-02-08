<?php
use Illuminate\Support\Facades\Route;
use studiobarg\Dashboard\Http\Controllers\DashboardController;

Route::group(['namespace' => 'studiobarg\Dashboard\Http\Controllers','middleware'=>['web','auth', 'verified']], function ($router) {
    $router->get('/dashboard',[DashboardController::class,'home'])
    ->name('dashboard');
});

