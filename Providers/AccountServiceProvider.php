<?php

namespace Apolune\Account\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Apolune\Contracts\Account\Account', 'Apolune\Account\Account');
        $this->app->bind('Apolune\Contracts\Account\AccountProperties', 'Apolune\Account\AccountProperties');
        $this->app->bind('Apolune\Contracts\Account\Player', 'Apolune\Account\Player');

        $this->app->register('Apolune\Account\Providers\HashServiceProvider');
        $this->app->register('Apolune\Account\Providers\AuthServiceProvider');
        $this->app->register('Apolune\Account\Providers\ValidationServiceProvider');

        $this->app['migrations']->register(
            __DIR__.'/../resources/migrations'
        );
    }
}
