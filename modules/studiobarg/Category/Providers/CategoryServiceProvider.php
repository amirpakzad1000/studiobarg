<?php

namespace studiobarg\Category\Providers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/category_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations');
        Factory::guessFactoryNamesUsing(function ($modelName) {
            return 'Databases\\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }

    public function boot(): void
    {
           config()->set('sidebar.items.categories', [
               'url' => url('/categories'),
               'icon' => 'micon dw dw-layers',
               'title' => 'دسته‌بندی‌ها',
           ]);
    }
}
