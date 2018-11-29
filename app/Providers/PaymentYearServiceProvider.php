<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentYearServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\PaymentYearInterface',
            'App\Services\PaymentYearService'
        );
    }
}
