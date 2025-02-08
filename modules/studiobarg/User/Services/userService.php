<?php

namespace studiobarg\User\Services;

class userService
{
    public static function changePassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }
}
