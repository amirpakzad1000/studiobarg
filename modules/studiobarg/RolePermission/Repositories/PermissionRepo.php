<?php

namespace studiobarg\RolePermission\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepo
{
    public static function all()
    {
        return Permission::all();
  }

}
