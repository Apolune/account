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
        $this->app['migration.handler']
            ->migrate(__DIR__.'/../Resources/Migrations')
            ->using('Apolune\Account\Resources\Migrations')
            ->register();

        $this->app['seed.handler']->register(
            \Apolune\Account\Resources\Seeds\DatabaseSeeder::class
        );
    }
}
