<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Account\Player;
use Apolune\Contracts\Account\AccountProperties;
use Apolune\Contracts\Account\AccountRegistration;

trait Account
{
    /**
     * Retrieve the account properties.
     *
     * @return \Apolune\Contracts\Account\AccountProperties
     */
    public function properties()
    {
        return $this->hasOne(AccountProperties::class);
    }

    /**
     * Retrieve the account registration.
     *
     * @return \Apolune\Contracts\Account\AccountRegistration
     */
    public function registration()
    {
        return $this->hasOne(AccountRegistration::class);
    }

    /**
     * Retrieve the account players.
     *
     * @return \Illuminate\Support\Collection
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
