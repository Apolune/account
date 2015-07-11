<?php

namespace Apolune\Account\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Define all the model bindings.
     *
     * @var array
     */
    protected $bindings = [
        'account'               => ['Apolune\Contracts\Account\Account', 'Apolune\Account\Account'],
        'account.properties'    => ['Apolune\Contracts\Account\AccountProperties', 'Apolune\Account\AccountProperties'],
        'player'                => ['Apolune\Contracts\Account\Player', 'Apolune\Account\Player'],
    ];

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
        foreach ($this->bindings as $alias => $binding)
        {
            list($abstract, $concrete) = $binding;
            
            $this->app->bind([$alias => $abstract], $concrete);
        }

        $this->app->register('Apolune\Account\Providers\HashServiceProvider');
        $this->app->register('Apolune\Account\Providers\AuthServiceProvider');
        $this->app->register('Apolune\Account\Providers\ValidationServiceProvider');

        $this->app['migrations']->register(
            __DIR__.'/../resources/migrations'
        );
    }
}
