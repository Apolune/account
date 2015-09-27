<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Account\Account as AccountContract;
use Apolune\Contracts\Account\PlayerOnline as PlayerOnlineContract;
use Apolune\Contracts\Guilds\GuildMembership as GuildMembershipContract;
use Apolune\Contracts\Account\PlayerProperties as PlayerPropertiesContract;

trait Player
{
    /**
     * Retrieve the associated account.
     *
     * @return \Apolune\Contracts\Account\Account
     */
    public function account()
    {
        return $this->belongsTo(AccountContract::class);
    }

    /**
     * Retrieve the player properties.
     *
     * @return \Apolune\Contracts\Account\PlayerProperties
     */
    public function properties()
    {
        return $this->hasOne(PlayerPropertiesContract::class);
    }

    /**
     * Retrieve the associated guild membership.
     *
     * @return \Apolune\Contracts\Guilds\GuildMembership
     */
    public function guild()
    {
        return $this->hasOne(GuildMembershipContract::class);
    }

    /**
     * Retrieve the player online relationship.
     *
     * @return \Apolune\Contracts\Account\PlayerOnline
     */
    public function playerOnline()
    {
        return $this->hasOne(PlayerOnlineContract::class);
    }
}
