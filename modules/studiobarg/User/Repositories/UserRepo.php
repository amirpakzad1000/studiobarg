<?php

namespace studiobarg\User\Repositories;

use studiobarg\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getTeacher()
    {
        return User::role('teach')->get();
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
