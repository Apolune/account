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
        $this->bindContracts();

        $this->app->register('Apolune\Account\Providers\HashServiceProvider');
        $this->app->register('Apolune\Account\Providers\AuthServiceProvider');
        $this->app->register('Apolune\Account\Providers\ValidationServiceProvider');
    }

    /**
     * Bind the required contracts.
     *
     * @return void
     */
    private function bindContracts()
    {
        $this->app->bind('Apolune\Contracts\Account\Account', 'Apolune\Account\Models\Account');
        $this->app->bind('Apolune\Contracts\Account\Player', 'Apolune\Account\Models\Player');
    }
}
