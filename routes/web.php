<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

Route::get('/test', function () {

//    permission::create(['name' => 'manage categories']);
//    auth()->user()->givePermissionTo('manage teach');
//   return auth()->user()->permissions;
});
Route::get('/', function () {
    return view('welcome');
});



