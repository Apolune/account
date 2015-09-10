<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Account\Player as PlayerContract;
use Apolune\Contracts\Account\AccountProperties as AccountPropertiesContract;
use Apolune\Contracts\Account\AccountRegistration as AccountRegistrationContract;

trait Account
{
    /**
     * Retrieve the account properties.
     *
     * @return \Apolune\Contracts\Account\AccountProperties
     */
    public function properties()
    {
        return $this->hasOne(AccountPropertiesContract::class);
    }

    /**
     * Retrieve the account registration.
     *
     * @return \Apolune\Contracts\Account\AccountRegistration
     */
    public function registration()
    {
        return $this->hasOne(AccountRegistrationContract::class);
    }

    /**
     * Retrieve the account players.
     *
     * @return \Illuminate\Support\Collection
     */
    public function players()
    {
        return $this->hasMany(PlayerContract::class);
    }
}
