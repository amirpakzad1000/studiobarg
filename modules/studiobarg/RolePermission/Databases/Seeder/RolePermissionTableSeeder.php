<?php

namespace studiobarg\RolePermission\Databases\Seeder;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\studiobarg\RolePermission\Models\Permission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach (\studiobarg\RolePermission\Models\Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }
    }
}
