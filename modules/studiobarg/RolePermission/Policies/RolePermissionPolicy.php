<?php

namespace studiobarg\RolePermission\Policies;

use studiobarg\RolePermission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use studiobarg\User\Models\User;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    private function hasAccess(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSION);
    }

    public function index(User $user): bool
    {
        return $this->hasAccess($user);
    }

    public function create(User $user): bool
    {
        return $this->hasAccess($user);
    }

    public function edit(User $user): bool
    {
        return $this->hasAccess($user);
    }

    public function delete(User $user): bool
    {
        return $this->hasAccess($user);
    }
}
