<?php

namespace Kofikwarteng\LaravelSagepay;

use Illuminate\Support\ServiceProvider;

class SagepayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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
      $this->mergeConfigFrom( __DIR__.'/Config/sagepay.php', 'sagepay');
      $this->app['laravelsagepay'] = $this->app->share(function($app) {
  			return new SagePay;
  		});
    }
}
