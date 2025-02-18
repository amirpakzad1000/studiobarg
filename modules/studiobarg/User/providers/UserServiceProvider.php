<?php

namespace studiobarg\User\providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use studiobarg\User\Models\User;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        config()->set('auth.providers.users.model', User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadMigrationsFrom(__DIR__ . '/../DataBase/Migrations');

        // بارگذاری فکتوری‌ها برای ماژول
        Factory::guessFactoryNamesUsing(function ($User) {
            return 'studiobarg\\User\\Database\\Factories\\' . class_basename($User) . 'Factory';
        });
    }
}

