<?php

namespace studiobarg\RolePermission\Policies;

use studiobarg\RolePermission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION)) {
            return true;
        }

        return null;
    }

    public function create($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION)) {
            return true;
        }

        return null;
    }

    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION)) {
            return true;
        }

        return null;
    }

    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION)) {
            return true;
        }

        return null;
    }
}
