<?php

namespace studiobarg\Course\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\Course\Databases\Seeder\RolePermissionTableSeeder;
use studiobarg\Course\Models\Course;
use studiobarg\Course\Policies\CoursePolicy;

class CourseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/course_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', 'Courses');
        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;

        Gate::policy(Course::class, CoursePolicy::class);
    }

    public function boot(): void
    {
        config()->set('sidebar.items.courses', [
            'url' => url('/courses'),
            'icon' => 'micon dw dw-calendar1',
            'title' => 'دوره های آموزشی',
        ]);
    }
}
