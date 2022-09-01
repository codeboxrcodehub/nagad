<?php

namespace Codeboxr\Nagad;

use Codeboxr\Nagad\Payment\Refund;
use Codeboxr\Nagad\Payment\Payment;
use Illuminate\Support\ServiceProvider;

class NagadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../config/nagad.php" => config_path("nagad.php")
        ]);

        $this->loadRoutesFrom(__DIR__ . "/routes/nagad_route.php");
        $this->loadViewsFrom(__DIR__ . '/Views', 'nagad');
    }

    /**
     * Register application services
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/nagad.php", "nagad");

        $this->app->bind("payment", function () {
            return new Payment();
        });

        $this->app->bind("refundPayment", function () {
            return new Refund();
        });
    }
}
