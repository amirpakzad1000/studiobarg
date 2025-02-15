<?php

use Illuminate\Support\Facades\Route;
use studiobarg\Course\Http\Controllers\CourseController;

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::resource('/courses', CourseController::class);
});

