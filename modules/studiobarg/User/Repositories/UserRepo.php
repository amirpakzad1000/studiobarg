<?php

namespace studiobarg\User\Repositories;

use studiobarg\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
