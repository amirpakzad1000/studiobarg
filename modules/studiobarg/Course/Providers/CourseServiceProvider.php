<?php

namespace studiobarg\Course\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Policies\ArticlePolicy;
use studiobarg\Course\Policies\CoursePolicy;
use studiobarg\RolePermission\Models\Permission;


class CourseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/course_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Courses');
        Gate::policy(Course::class, CoursePolicy::class);

    }

    public function boot(): void
    {
        config()->set('sidebar.items.courses', [
            'url' => url('/courses'),
            'icon' => 'micon dw dw-calendar1',
            'title' => 'دوره های آموزشی',
            'permission' => [
                Permission::PERMISSION_MANAGE_COURSES,
                Permission::PERMISSION_MANAGE_OWN_COURSES,
            ],
        ]);
    }
}
