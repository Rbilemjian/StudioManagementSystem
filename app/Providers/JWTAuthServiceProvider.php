<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JWTAuthServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\JWTAuthInterface',
            'App\Services\JWTAuthService'
        );
    }
}
