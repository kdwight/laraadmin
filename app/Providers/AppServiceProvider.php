<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.users.create', 'admin.users.edit'], function ($view) {
            $view->with('roles', \App\Role::all());
        });

        view()->composer('*', function ($view) {
            $view->with('sidebar', json_decode(auth()->user()->hasAccess()->access));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
