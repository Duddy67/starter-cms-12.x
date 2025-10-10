<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set variables related to the cookie info dialog (gdpr).
        $cookieInfoConfig = config('cookie-info');
        $cookieInfoAlreadyChecked = Cookie::has($cookieInfoConfig['cookie_name']);

        view()->share(compact('cookieInfoAlreadyChecked', 'cookieInfoConfig'));
    }
}
