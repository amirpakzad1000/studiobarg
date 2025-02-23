<?php

namespace studiobarg\User\providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\User\DataBase\Seeder\UserTableSeeder;
use studiobarg\User\Models\User;
use studiobarg\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadMigrationsFrom(__DIR__ . '/../DataBase/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');

        // بارگذاری فکتوری‌ها برای ماژول
        Factory::guessFactoryNamesUsing(function ($User) {
            return 'studiobarg\\User\\Database\\Factories\\' . class_basename($User) . 'Factory';
        });

        config()->set('auth.providers.users.model', User::class);
        Gate::policy(User::class, UserPolicy::class);
        DatabaseSeeder::$seeders[] = UserTableSeeder::class;
    }

    public function boot()
    {
        config()->set('sidebar.items.users', [
            'url' => url('/users'),
            'icon' => 'micon dw dw-layers',
            'title' => 'کاربران',
        ]);
    }
}

