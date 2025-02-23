<?php

namespace studiobarg\User\DataBase\Seeder;


use Illuminate\Database\Seeder;
use studiobarg\User\Models\User;


class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::$defaultUsers as $user) {
            User::firstOrCreate(['email'=> $user['email']],
                [
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'name' => $user['name'],
            ])->assignRole($user['role']);
        }
    }
}
