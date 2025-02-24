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

    public function getAuthor()
    {
        return User::role(Permission::PERMISSION_AUTHOR)->get();
    }

    public function findById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate()
    {
        return User::paginate();
    }

    public function update($userId, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'mobile' => $values->mobile,
            'username' => $values->username,
            'status' => $values->status,
            'bio' => $values->bio,
            'instagram' => $values->instagram,
            'facebook' => $values->facebook,
            'twitter' => $values->twitter,
            'linkedin' => $values->linkedin,
            'website' => $values->website,
            'github' => $values->github,
            'youtube' => $values->youtube,
        ];
        if (!is_null($values->new_password)) {
            $update['password'] = bcrypt($values->new_password);
        }

        $user = User::find($userId);
        $user->syncRoles([]);
        if ($values['role']) {
            $user->assignRole($values['role']);
        }

        return User::where('id', $userId)->update($update);
    }
}
