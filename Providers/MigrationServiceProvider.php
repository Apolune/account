<?php

namespace Apolune\Account\Providers;

use Apolune\Core\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
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
        $this->app['migration.handler']->register(
            __DIR__.'/../resources/migrations'
        );
    }
}
