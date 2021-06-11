<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
        if (env("REDIRECT_HTTPS") app()->request->server->set("HTTPS", true) ;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot (UrlGenerator $url)
    {
        if (env("REDIRECT_HTTPS") $url->formatScheme("https://") ;
    }
}