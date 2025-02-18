<?php

namespace studiobarg\RolePermission\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\RolePermission\Models\Permission;

class RolePermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/permission_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'RolePermissions');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');

        Gate::before(function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
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
