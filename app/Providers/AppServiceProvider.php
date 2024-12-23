<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\GreetingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('greeting', function () {
            return new GreetingService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
