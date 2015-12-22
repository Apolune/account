<?php

namespace Apolune\Account\Providers;

use Apolune\Core\ServiceProvider;
use Apolune\Account\Services\Auth\EloquentUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->provider('pandaac', function ($app, array $config) {
            return new EloquentUserProvider($app, $app['hash'], $config['model']);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
