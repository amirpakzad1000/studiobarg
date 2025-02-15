<?php

use Studiobarg\Category\Http\Controllers\CategoryController;

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class)->middleware('permission:manage categories');
});
