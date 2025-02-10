<?php

namespace studiobarg\User\providers;


use Illuminate\Database\Eloquent\Factories\Factory;
use studiobarg\User\Models\User;
use Illuminate\Support\ServiceProvider;

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

        Factory::guessFactoryNamesUsing(function ($modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }
}

