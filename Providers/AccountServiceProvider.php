<?php

namespace Apolune\Account\Providers;

use Apolune\Account;
use Apolune\Contracts\Account as Contracts;
use Apolune\Core\Providers\AggregateServiceProvider;

class AccountServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        HashServiceProvider::class,
        AuthServiceProvider::class,
        ValidationServiceProvider::class,
        MigrationServiceProvider::class,
    ];

    /**
     * Holds all of the contracts we want to bind.
     *
     * @var array
     */
    protected $bindings = [
        'account'               => [Contracts\Account::class => Account\Account::class],
        'account.properties'    => [Contracts\AccountProperties::class => Account\AccountProperties::class],
        'player'                => [Contracts\Player::class => Account\Player::class],
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
}
