<?php

namespace Gerro\Dotpay;

use Illuminate\Support\ServiceProvider;

class GerroDotpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/config/dotpay.php'=>config_path('dotpay.php'),
            ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /* 
        $this->app['dotpay'] = $this->app->singleton(function($app)
        {
            return new Dotpay();
        });
        */
        $this->app->singleton(Dotpay::class, function($app){
            return new Dotpay();
        });
    }
}
