<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

 //permission::create(['name' => \studiobarg\RolePermission\Models\Permission::PERMISSION_SUPER_ADMIN]);
//    auth()->user()->givePermissionTo(\studiobarg\RolePermission\Models\Permission::PERMISSION_SUPER_ADMIN);
//  return auth()->user()->permissions;
    dd(auth()->user()->hasRole('super admin'));

});
Route::get('/', function () {
    return view('welcome');
});



