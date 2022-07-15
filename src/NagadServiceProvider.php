<?php

namespace Codeboxr\Nagad;

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
    }

    /**
     * Register application services
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/nagad.php", "nagad");
    }
}
