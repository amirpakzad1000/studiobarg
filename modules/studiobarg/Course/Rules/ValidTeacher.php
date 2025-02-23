<?php

namespace studiobarg\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\User\Repositories\UserRepo;

class ValidTeacher implements Rule
{

    public function passes($attribute, $value)
    {
      $user = resolve(UserRepo::class)->findById($value);
      return $user->hasPermissionTo(Permission::PERMISSION_TEACH);
    }

    public function message()
    {
        return "کاربر مورد نظر تایید شده نیست";
    }
}
