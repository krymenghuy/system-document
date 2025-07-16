<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\View;
use App\Models\Company;
=======
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf

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
<<<<<<< HEAD
        View::composer('backends.layouts.sidebar', function ($view) {
            $view->with('company', Company::first());
        });
=======
        //
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
    }
}
