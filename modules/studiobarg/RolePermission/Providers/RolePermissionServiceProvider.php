<?php

namespace studiobarg\RolePermission\Providers;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\RolePermission\Databases\Seeder\RolePermissionTableSeeder;
use studiobarg\RolePermission\Models\Permission;
use studiobarg\RolePermission\Models\Role;
use studiobarg\RolePermission\Policies\RolePermissionPolicy;

class RolePermissionServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/permission_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'RolePermissions');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');

        Gate::policy(Role::class, RolePermissionPolicy::class);
        Gate::before(function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });

        Factory::guessFactoryNamesUsing(function ($modelName) {
            return 'Databases\\Factories\\' . class_basename($modelName) . 'Factory';
        });

        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
    }


    public function boot(): void
    {
        config()->set('sidebar.items.role-permissions', [
            'url' => url('/role-permissions'),
            'icon' => 'micon dw dw-shield1',
            'title' => 'نقش های کاربری',
        ]);
    }
}
