<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\PaymentInterface',
            'App\Services\PaymentService'
        );
    }
}
