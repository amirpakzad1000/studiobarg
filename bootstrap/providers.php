<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    studiobarg\Category\providers\CategoryServiceProvider::class,
    studiobarg\Dashboard\Providers\DashboardServiceProvider::class,
    studiobarg\RolePermission\providers\RolePermissionServiceProvider::class,
    studiobarg\User\providers\UserServiceProvider::class,
    studiobarg\Course\Providers\CourseServiceProvider::class,
    studiobarg\Media\Providers\MediaServiceProvider::class,
];
