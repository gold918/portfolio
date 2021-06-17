<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        View::composer(['layouts.admin', 'admin.index'], function($view) {
            $userRoles = Auth::user()->role->rules()->pluck('title')->all();
            $view->with(['userRoles' => $userRoles]);
        });

/*        view()->composer('layouts.admin', function($view)
        {
            $userRoles = Auth::user()->role->rules()->pluck('title')->all();
            $view->with('userRoles', $userRoles);

        });*/
    }
}
