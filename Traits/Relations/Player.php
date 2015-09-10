<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Guilds\Guild as GuildContract;
use Apolune\Contracts\Account\Account as AccountContract;
use Apolune\Contracts\Guilds\GuildRank as GuildRankContract;
use Apolune\Contracts\Guilds\GuildMember as GuildMemberContract;
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
     * Retrieve the associated guild.
     *
     * @return \Apolune\Contracts\Guilds\Guild
     */
    public function guild()
    {
        return $this->hasOneThrough(GuildContract::Class, GuildMemberContract::class, 'player_id', 'guild_id');
    }

    /**
     * Retrieve the associated guild.
     *
     * @return \Apolune\Contracts\Guilds\GuildRank
     */
    public function guildrank()
    {
        return $this->hasOneThrough(GuildRankContract::Class, GuildMemberContract::class, 'player_id', 'rank_id');
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
