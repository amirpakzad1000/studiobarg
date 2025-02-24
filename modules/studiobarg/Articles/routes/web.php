<?php

use Illuminate\Support\Facades\Route;
use studiobarg\Articles\Http\Controllers\ArticlesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::resource('articles', ArticlesController::class);
});
