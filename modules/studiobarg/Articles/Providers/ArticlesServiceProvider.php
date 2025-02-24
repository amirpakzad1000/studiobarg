<?php

namespace studiobarg\Articles\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use studiobarg\Articles\Models\Article;
use studiobarg\Articles\Policies\ArticlePolicy;

class ArticlesServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'Article');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/Lang');
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);

        Gate::policy(Article::class, ArticlePolicy::class);
    }

    public function boot(): void
    {
        config()->set('sidebar.items.articles', [
            'url' => url('/articles'),
            'icon' => 'micon dw dw-calendar1',
            'title' => 'مقالات',
        ]);
    }
}
