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
        * for laravel 5.2, laravel 5.3
        */
        $this->app['dotpay'] = $this->app->share(function($app)
        {
            return new Dotpay();
        });
        
        /* for laravel 5.4 
        
        $this->app->singleton(Dotpay::class, function($app){
            return new Dotpay();
        });
        
        */
    }
}
