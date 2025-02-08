<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'studiobarg\Category\Http\Controllers','middleware'=>['web','auth','verified']],function ($router){
    $router->resource('categories', CategoryController::class);
});
