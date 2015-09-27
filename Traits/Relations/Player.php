<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Guilds\Guild as GuildContract;
use Apolune\Contracts\Account\Account as AccountContract;
use Apolune\Contracts\Guilds\GuildRank as GuildRankContract;
use Apolune\Contracts\Account\PlayerOnline as PlayerOnlineContract;
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
     *
     */
    public function guild()
    {
    }

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
