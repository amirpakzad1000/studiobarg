<?php

namespace studiobarg\User\Repositories;

use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeacher()
    {
        return User::role(Permission::PERMISSION_TEACH)->get();
    }
    public function findById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // خطا را مدیریت کنید
            return null; // یا خطای مناسب
        }
    }
}
