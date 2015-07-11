<?php

namespace Apolune\Account\Providers;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Holds all of the contracts we want to bind.
     *
     * @var array
     */
    protected $bindings = [
        'account'               => ['Apolune\Contracts\Account\Account', 'Apolune\Account\Account'],
        'account.properties'    => ['Apolune\Contracts\Account\AccountProperties', 'Apolune\Account\AccountProperties'],
        'player'                => ['Apolune\Contracts\Account\Player', 'Apolune\Account\Player'],
    ];

    /**
     * Holds all of the service providers we want to register.
     *
     * @var array
     */
    protected $providers = [
        HashServiceProvider::class,
        AuthServiceProvider::class,
        ValidationServiceProvider::class,
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
        $this->bindings();
        $this->providers();

        $this->app['migrations']->register(
            __DIR__.'/../resources/migrations'
        );
    }

    /**
     * Handle all of the container bindings.
     *
     * @return void
     */
    private function bindings()
    {
        foreach ($this->bindings as $alias => $binding) {
            list($abstract, $concrete) = $binding;
            
            $this->app->bind([$alias => $abstract], $concrete);
        }
    }

    /**
     * Register all of the service providers.
     *
     * @return void
     */
    private function providers()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
