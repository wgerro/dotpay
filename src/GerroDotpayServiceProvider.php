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
                __DIR__.'/Gerro/Dotpay/config/dotpay.php'=>config_path('dotpay.php'),
            ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['dotpay'] = $this->app->share(function($app)
        {
            return new Dotpay();
        });
    }
}
