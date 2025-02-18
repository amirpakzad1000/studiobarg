<?php

namespace studiobarg\Category\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }

}
