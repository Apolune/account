<?php

namespace Apolune\Account\Traits\Relations;

use Apolune\Contracts\Guilds\Guild;
use Apolune\Contracts\Account\Account;
use Apolune\Contracts\Guilds\GuildRank;
use Apolune\Contracts\Guilds\GuildMember;
use Apolune\Contracts\Account\PlayerOnline;
use Apolune\Contracts\Account\PlayerProperties;

trait Player
{
    /**
     * Retrieve the associated account.
     *
     * @return \Apolune\Contracts\Account\Account
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Retrieve the player properties.
     *
     * @return \Apolune\Contracts\Account\PlayerProperties
     */
    public function properties()
    {
        return $this->hasOne(PlayerProperties::class);
    }

    /**
     * Retrieve the associated guild.
     *
     * @return \Apolune\Contracts\Guilds\Guild
     */
    public function guild()
    {
        return $this->hasOneThrough(Guild::Class, GuildMember::class, 'player_id', 'guild_id');
    }

    /**
     * Retrieve the associated guild.
     *
     * @return \Apolune\Contracts\Guilds\GuildRank
     */
    public function guildrank()
    {
        return $this->hasOneThrough(GuildRank::Class, GuildMember::class, 'player_id', 'rank_id');
    }

    /**
     * Retrieve the player online relationship.
     *
     * @return \Apolune\Contracts\Account\PlayerOnline
     */
    public function playerOnline()
    {
        return $this->hasOne(PlayerOnline::class);
    }
}
