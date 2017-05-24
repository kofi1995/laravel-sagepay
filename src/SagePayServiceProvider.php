<?php

namespace Kofikwarteng\LaravelSagepay;

use Illuminate\Support\ServiceProvider;

class SagePayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      //copy the package's config file to laravel's config directory
      $this->publishes([
    __DIR__.'/Config/sagepay.php' => config_path('sagepay.php'),
        ], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      //get the config from the config file, that way, we can have access to it in our Model
      $this->mergeConfigFrom( __DIR__.'/Config/sagepay.php', 'sagepay');

        $this->app->singleton('laravelsagepay', function ($app) {
            return new SagePay($app);
        });
    }
}
