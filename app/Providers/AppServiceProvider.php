<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer(['admin.users.create', 'admin.users.edit'], function ($view) {
        //     $view->with('roles', \App\Role::all());
        // });

        // view()->composer('admin.layouts.navbars.sidebar', function ($view) {
        //     if (auth()->check()) {
        //         $view->with('sidebar', json_decode(auth()->user()->hasAccess()->access));
        //     }
        // });
    }
}
