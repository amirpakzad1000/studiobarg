<?php

namespace studiobarg\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/dashboard_routes.php');
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Dashboard");
        $this->mergeConfigFrom(__DIR__ . "/../Config/sidebar.php", "sidebar");
    }

    public function boot(): void
    {
        $this->app->booted(function () {
            if (\Illuminate\Support\Facades\Route::has('dashboard')) {
                config(['sidebar.items.dashboard' => [
                    'url' => url('/dashboard'),
                    'icon'  => 'micon bi bi-house',
                    'title' => 'داشبورد'
                ]]);
            }
        });
    }

}
