<?php

Route::group(['namespace'=>'studiobarg\User\HTTP\Controllers','middleware' => ['web']], function ($router) {
    require __DIR__ . '/auth.php';
});
