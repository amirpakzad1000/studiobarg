<?php

namespace studiobarg\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;

class CoursePolicy
{
    use HandlesAuthorization;
    public function __construct()
    {
        //
    }
    public function manage(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            return true;
        }
    }

    public function create(user $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            return true;
        }
    }

    public function edit(User $user,$course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $course->teacher_id == $user->id) {
            return true;
        }
    }

    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        return null;
    }

    public function change_confirmation_status($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        return null;
    }
}
