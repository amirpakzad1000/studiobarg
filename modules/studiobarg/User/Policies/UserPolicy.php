<?php

namespace studiobarg\User\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use studiobarg\RolePermission\Models\Permission;

class UserPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function manualVerify($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function addRole($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function removeRole($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function editProfile($user)
    {
        if (auth()->check()) {
            return true;
        }
    }
}
