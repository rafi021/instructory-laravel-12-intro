<?php

namespace App\Providers;

use App\Billing\Calculator;
use App\Billing\PaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGateway::class, function ($app) {
            return new PaymentGateway('usd');
        });

        $this->app->bind('Math', Calculator::class);;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
