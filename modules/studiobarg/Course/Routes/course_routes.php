<?php

use Illuminate\Support\Facades\Route;
use studiobarg\Course\Http\Controllers\CourseController;

Route::middleware(['web', 'auth', 'verified'])->group(function ($router) {
    $router->resource('/courses', CourseController::class);
    $router->patch('/courses/{course}/accept', [CourseController::class, 'accept'])->name('course.accept');
    $router->patch('/courses/{course}/reject', [CourseController::class, 'reject'])->name('course.reject');
    $router->patch('/courses/{course}/lock', [CourseController::class, 'lock'])->name('course.lock');
});


