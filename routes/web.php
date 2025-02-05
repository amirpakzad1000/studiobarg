<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('User::Front.dashboard');
})->name('dashboard');

Route::get('/test', function () {
    return new \studiobarg\User\Mail\VerifyCodeMail(214214);
});


Route::get('/', function () {
    return view('welcome');
});



