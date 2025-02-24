<?php

namespace studiobarg\Articles\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;
use studiobarg\Articles\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;


    private function hasGeneralAccess(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_POST) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_POST);
    }

    public function index(User $user): bool
    {
        return $this->hasGeneralAccess($user);
    }

    public function create(User $user): bool
    {
        return $this->hasGeneralAccess($user);
    }

    public function edit(User $user, Article $article): bool
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_POST)) {
            return true;
        }

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_POST) &&
            $article->author_id == $user->id;
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_POST);
    }

    public function changeConfirmationStatus(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_POST);
    }
}
