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
    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function edit(User $user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) &&
            $course->teacher_id == $user->id;
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    public function change_confirmation_status(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
}
