<?php

use studiobarg\RolePermission\Http\Controllers\RolePermissionsController;
Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::resource('role-permissions', RolePermissionsController::class);
});
