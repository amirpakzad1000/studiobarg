<?php

namespace studiobarg\RolePermission\Models;

class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'teacher';
    const ROLE_AUTHOR = 'author';
    const ROLE_SUPER_ADMIN = 'super admin';
    const ROLE_STUDENT = 'student';
    static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ],
        self::ROLE_SUPER_ADMIN => [
            Permission::PERMISSION_SUPER_ADMIN
        ],
        self::ROLE_AUTHOR => [
            Permission::PERMISSION_AUTHOR
        ],
        self::ROLE_STUDENT => [

        ]
    ];
}
