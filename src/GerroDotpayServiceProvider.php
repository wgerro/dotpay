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
        if ((float)$this->app->version() >= 5.4) {
            $this->app->singleton('dotpay' , function() {
                return new Dotpay();
            });
        } else {
            $this->app['dotpay'] = $this->app->share(function($app)
            {
                return new Dotpay();
            });
        }
    }
}
