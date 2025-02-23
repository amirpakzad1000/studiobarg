<?php

namespace studiobarg\Common\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    private $namespace = "studiobarg\Common\Http\Controllers";

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources', 'Common');
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__.'/../Routes/routes.php');
    }

    public function boot()
    {
//        view()->composer('Dashboard::layout.header', function ($view) {
//            $notifications = auth()->user()->unreadNotifications;
//
//            return $view->with(compact('notifications'));
//        });


    }
}
